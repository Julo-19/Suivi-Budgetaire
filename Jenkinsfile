pipeline {
  agent any

  environment {
    IMAGE_NAME = 'julo1997/suivi-budgetaire'
    IMAGE_TAG = 'latest'
    PATH = "/usr/local/bin:/usr/bin:/bin:/usr/sbin:/sbin"
  }

  stages {
    stage('Cloner le dépôt') {
      steps {
        git branch: 'master',
            url: 'https://github.com/Julo-19/Suivi-Budgetaire.git'
      }
    }
   stage('Analyse SonarQube') {
            steps {
                withCredentials([string(credentialsId: 'sonar-token', variable: 'SONAR_TOKEN')]) {
                    withSonarQubeEnv('Sonar-Jenkins') {
                        sh '''
                            sonar-scanner \
                            -Dsonar.projectKey=Suivi-Depense-Budget \
                            -Dsonar.sources=. \
                            -Dsonar.host.url=http://localhost:9000 \
                            -Dsonar.login=$SONAR_TOKEN
                        '''
                    }
                }
            }
        }





    stage('Build Docker Image') {
      steps {
        sh 'docker build -t $IMAGE_NAME:$IMAGE_TAG .'
      }
    }

    stage('Lister Images Docker') {
      steps {
        sh 'docker images'
      }
    }

    stage('Push Docker Image') {
      steps {
        withCredentials([usernamePassword(credentialsId: 'dockerHub-credentials', passwordVariable: 'DOCKER_PASS', usernameVariable: 'DOCKER_USER')]) {
          sh '''
            echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin
            docker push $IMAGE_NAME:$IMAGE_TAG
          '''
        }
      }
    }
  }

  post {
    failure {
      echo '❌ Pipeline échoué.'
    }
    success {
      echo '✅ Pipeline réussi.'
    }
  }
}
