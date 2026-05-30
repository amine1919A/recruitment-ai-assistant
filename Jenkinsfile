pipeline {
    agent any

    environment {
        IMAGE = "amineabdelli1/recruitment-ai"
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
                -v $WORKSPACE:/app \
                -w /app \
                composer:latest \
                sh -c "
                composer install &&
                php artisan test
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