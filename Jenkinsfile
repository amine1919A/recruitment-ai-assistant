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
        stage('Tests (PHPUnit)') {
            steps {
                sh '''
                    docker run --rm \
                        -v "$WORKSPACE":/var/www \
                        -w /var/www \
                        -e APP_ENV=testing \
                        -e APP_KEY=base64:2fl+Jb4JHbHvaTFgE3BNpjLDfkKIHpBHjqFmJPXhMew= \
                        -e DB_CONNECTION=sqlite \
                        -e DB_DATABASE=/tmp/test.db \
                        -e DEBIAN_FRONTEND=noninteractive \
                        php:8.2-cli \
                        bash -c "
                            apt-get update -qq &&
                            apt-get install -y -qq --no-install-recommends unzip curl git libzip-dev libonig-dev libxml2-dev libsqlite3-dev &&
                            docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip &&
                            curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer &&
                            composer install --no-interaction --prefer-dist --quiet &&
                            php artisan test --env=testing
                        "
                '''
            }
        }
        stage('SonarCloud Analysis') {
            steps {
                withSonarQubeEnv('SonarCloud') {
                    sh '''
                        sonar-scanner \
                        -Dsonar.projectKey=recruitment-ai-assistant \
                        -Dsonar.organization=amine1919a \
                        -Dsonar.sources=. \
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