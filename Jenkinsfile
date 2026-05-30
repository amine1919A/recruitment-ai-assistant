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
                sh 'docker image inspect laravel-test:latest > /dev/null 2>&1 || docker build -f Dockerfile.test -t laravel-test:latest .'
            }
        }
        stage('Tests (PHPUnit)') {
            steps {
                sh '''
                    MANIFEST='{"resources/js/app.js":{"file":"assets/app.js","src":"resources/js/app.js","isEntry":true,"css":["assets/app.css"]},"resources/css/app.css":{"file":"assets/app.css","src":"resources/css/app.css","isEntry":true}}'
                    docker run --rm \
                        -v /var/lib/docker/volumes/jenkins_home/_data/workspace/recruitment-ai-assistant:/var/www \
                        -w /var/www \
                        -e APP_ENV=testing \
                        -e APP_KEY=base64:2fl+Jb4JHbHvaTFgE3BNpjLDfkKIHpBHjqFmJPXhMew= \
                        -e DB_CONNECTION=sqlite \
                        -e DB_DATABASE=/tmp/test.db \
                        -e MANIFEST="$MANIFEST" \
                        laravel-test:latest \
                        bash -c 'composer install --no-interaction --prefer-dist --quiet && mkdir -p public/build/assets && touch public/build/assets/app.js public/build/assets/app.css && echo $MANIFEST > public/build/manifest.json && php artisan test --env=testing 2>&1'
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
                        -Dsonar.exclusions=vendor/**,node_modules/**,public/**,resources/js/**,resources/css/**,*.js,*.ts \
                        -Dsonar.host.url=https://sonarcloud.io \
                        -Dsonar.token=fd373d6a39ad57c37e3691802c195bb79abb9e34 \
                        -Dsonar.javascript.node.maxspace=512 \
                        -Dsonar.language=php
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
        stage('Deploy Kubernetes') {
            steps {
                sh '''
                    export KUBECONFIG=/var/jenkins_home/.kube/config
                    kubectl apply -f k8s/mysql.yaml
                    kubectl apply -f k8s/deployment.yaml
                    kubectl apply -f k8s/service.yaml
                    kubectl rollout restart deployment/laravel-app
                    kubectl rollout status deployment/laravel-app --timeout=120s
                '''
            }
        }
    }
    post {
        success {
            echo "SUCCESS - App sur http://localhost:30080"
        }
        failure {
            echo "FAILED"
        }
    }
}