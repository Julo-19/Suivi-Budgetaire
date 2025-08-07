pipeline {
    agent any

    environment {
        IMAGE_NAME = 'julo19/suivi-budgetaire'
        IMAGE_TAG = 'latest'
    }

    stages {
        stage('Cloner le dépôt') {
            steps {
                git branch: 'main',
                    url: 'https://github.com/Julo-19/Suivi-Budgetaire.git'
            }
        }

        stage('Construire l’image Docker') {
            steps {
                sh 'docker build -t julo19/suivi-budgetaire:latest .'
            }
        }

        // Active cette partie si tu veux pousser sur Docker Hub
        
        stage('Pusher sur Docker Hub') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'dockerhub-credentials',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh 'echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin'
                    sh 'docker push $IMAGE_NAME:$IMAGE_TAG'
                }
            }
        }

    }
}
