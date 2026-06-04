pipeline {
    agent any
    environment {
        IMAGE = "amineabdelli1/recruitment-ai"
        TAG   = "${BUILD_NUMBER}"
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
                    MANIFEST='{"resources/js/app.jsx":{"file":"assets/app-961NTWgG.js","src":"resources/js/app.jsx","isEntry":true,"css":["assets/app-ElNpJpiu.css"]}}'
                    docker run --rm \
                        -v /var/lib/docker/volumes/jenkins_home/_data/workspace/recruitment-ai-assistant:/var/www \
                        -w /var/www \
                        -e APP_ENV=testing \
                        -e APP_KEY=base64:2fl+Jb4JHbHvaTFgE3BNpjLDfkKIHpBHjqFmJPXhMew= \
                        -e DB_CONNECTION=sqlite \
                        -e DB_DATABASE=/tmp/test.db \
                        -e MANIFEST="$MANIFEST" \
                        laravel-test:latest \
                        bash -c 'composer install --no-interaction --prefer-dist --quiet && mkdir -p public/build/assets && touch public/build/assets/app-961NTWgG.js public/build/assets/app-ElNpJpiu.css && echo $MANIFEST > public/build/manifest.json && php artisan test --env=testing 2>&1'
                '''
            }
        }
        stage('SonarCloud Analysis') {
            options {
                timeout(time: 60, unit: 'MINUTES')
            }
            steps {
                withSonarQubeEnv('SonarCloud') {
                    withEnv([
                        "PATH+SONAR=${tool 'SonarScanner'}/bin",
                        "SONAR_SCANNER_OPTS=-Djava.net.preferIPv4Stack=true"
                    ]) {
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
        }
        stage('Build Docker Image') {
            steps {
                sh '''
                    docker build --no-cache -t $IMAGE:$TAG .
                    docker tag $IMAGE:$TAG $IMAGE:latest
                '''
            }
        }
        stage('Push DockerHub') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerhub', usernameVariable: 'USER', passwordVariable: 'PASS')]) {
                    sh '''
                        # Force IPv4 pour Docker Hub
                        printf "172.64.144.78 auth.docker.io\n104.18.43.178 auth.docker.io\n52.205.187.141 registry-1.docker.io\n107.23.56.59 registry-1.docker.io\n52.205.187.141 index.docker.io\n" | tee -a /etc/hosts || true

                        echo $PASS | docker login -u $USER --password-stdin
                        docker push $IMAGE:$TAG
                        docker push $IMAGE:latest
                    '''
                }
            }
        }
        stage('Deploy Kubernetes') {
            steps {
                sh '''
                    set -e
                    export KUBECONFIG=/var/jenkins_home/.kube/config

                    # Fix DNS pour kubernetes.docker.internal
                    grep -q "kubernetes.docker.internal" /etc/hosts || \
                        echo "172.17.0.1 kubernetes.docker.internal" >> /etc/hosts

                    echo "Deploying build #$TAG..."
                    kubectl set image deployment/laravel-app laravel=$IMAGE:$TAG
                    kubectl rollout restart deployment/laravel-app
                    kubectl rollout status deployment/laravel-app --timeout=300s
                    echo "Deployment finished"
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