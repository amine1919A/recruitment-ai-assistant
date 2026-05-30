pipeline {
    agent any
    environment {
        IMAGE = "amineabdelli1/recruitment-ai-assistant"
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Docker Check') {
            steps {
                sh 'docker version'
            }
        }
        stage('Build Test Image') {
            steps {
                sh 'docker build -f Dockerfile.test -t laravel-test:latest . '
            }
        }
        stage('Tests (PHPUnit)') {
            steps {
                sh '''
                    docker run --rm \
                        -v /var/lib/docker/volumes/jenkins_home/_data/workspace/recruitment-ai-assistant-final:/var/www \
                        -w /var/www \
                        -e APP_ENV=testing \
                        -e APP_KEY="base64:2fl+Jb4JHbHvaTFgE3BNpjLDfkKIHpBHjqFmJPXhMew=" \
                        -e DB_CONNECTION=sqlite \
                        -e DB_DATABASE=/tmp/test.db \
                        laravel-test:latest \
                        bash -c "
                            composer install --no-interaction --prefer-dist --quiet &&
                            mkdir -p public/build/assets &&
                            cat > public/build/manifest.json << 'EOF'
        {
            \"resources/js/app.js\": {
                \"file\": \"assets/app.js\",
                \"src\": \"resources/js/app.js\",
                \"isEntry\": true,
                \"css\": [\"assets/app.css\"]
            },
            \"resources/css/app.css\": {
                \"file\": \"assets/app.css\",
                \"src\": \"resources/css/app.css\",
                \"isEntry\": true
            }
        }
        EOF
                            touch public/build/assets/app.js public/build/assets/app.css &&
                            php artisan test --env=testing 2>&1
                        "
                '''
            }
        }
        stage('SonarCloud Analysis') {
            steps {
                withSonarQubeEnv('SonarCloud') {
                    sh '''
                        sonar-scanner \
                        -Dsonar.projectKey=amine1919A_recruitment-ai-assistant \
                        -Dsonar.organization=amine1919a \
                        -Dsonar.sources=. \
                        -Dsonar.exclusions=vendor/**,node_modules/**,public/build/** \
                        -Dsonar.host.url=https://sonarcloud.io \
                        -Dsonar.token=${SONAR_TOKEN}
                    '''
                }
            }
        }
        stage('Build Docker Image') {
            steps {
                sh 'docker build -t $IMAGE:latest .'
            }
        }
        stage('Push DockerHub') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerhub', usernameVariable: 'USER', passwordVariable: 'PASS')]) {
                    sh '''
                        echo $PASS | docker login -u $USER --password-stdin
                        docker push $IMAGE:latest
                    '''
                }
            }
        }
    }
    post {
        success {
            echo "✅ SUCCESS"
        }
        failure {
            echo "❌ FAILED"
        }
    }
}