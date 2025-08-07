pipeline {
    agent any

    environment {
        IMAGE_NAME = 'julo1997/suivi-budgetaire'
        IMAGE_TAG = 'latest'
    }

    stages {
        stage('Cloner le dépôt') {
            steps {
                git branch: 'master',
                    url: 'https://github.com/Julo-19/Suivi-Budgetaire.git'
            }
        }

        stage('Construire l’image Docker') {
            steps {
                 sh 'docker build -t julo1997/suivi-budgetaire:latest .'
            }
        }

        stage('Lister images Docker') {
            steps {
                sh 'docker images'
            }
        }

        stage('Pusher sur Docker Hub') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'dockerHub-credentials',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh 'echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin'
                    sh 'docker push $IMAGE_NAME:$IMAGE_TAG'
                }
            }
        }

    }

    post {
        success {
            echo '✅ Pipeline terminé avec succès !'
        }
        failure {
            echo '❌ Pipeline échoué.'
        }
    }
}
