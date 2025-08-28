pipeline {
    agent any

    environment {
        IMAGE_NAME = 'julo1997/suivi-budgetaire'
        IMAGE_TAG = "${env.GIT_COMMIT.take(7)}" // version basée sur le commit
        PATH = "/usr/local/bin:/usr/bin:/bin:/usr/sbin:/sbin"
        K8S_NAMESPACE = "default" // modifie si nécessaire
    }

    stages {
        stage('Cloner le dépôt') {
            steps {
                git branch: 'master',
                    url: 'https://github.com/Julo-19/Suivi-Budgetaire.git'
            }
        }

        stage('Scan SonarQube') {
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

        stage('Déploiement Kubernetes') {
            steps {
                // On récupère le kubeconfig stocké dans Jenkins
                withCredentials([file(credentialsId: 'kubeconfig', variable: 'KUBECONFIG_FILE')]) {
                    sh """
                        export KUBECONFIG=$KUBECONFIG_FILE
                        
                        # Appliquer les secrets et configmaps
                        kubectl apply -f k8s/app-secret.yaml -n $K8S_NAMESPACE
                        kubectl apply -f k8s/configMap.yaml -n $K8S_NAMESPACE
                        
                        # Déployer MySQL
                        kubectl apply -f k8s/mysql.yaml -n $K8S_NAMESPACE
                        kubectl apply -f k8s/app-service.yaml -n $K8S_NAMESPACE
                        
                        # Déployer Laravel
                        sed -i 's|image: .*|image: $IMAGE_NAME:$IMAGE_TAG|' k8s/suivi-depense-budg-deployment.yaml
                        kubectl apply -f k8s/app-deployment.yaml -n $K8S_NAMESPACE
                        kubectl apply -f k8s/suivi-depense-budg-service.yaml -n $K8S_NAMESPACE
                        
                        # Appliquer Ingress
                        kubectl apply -f k8s/ingress.yaml -n $K8S_NAMESPACE
                    """
                }
            }
        }

        stage('Vérification du déploiement') {
            steps {
                withCredentials([file(credentialsId: 'kubeconfig', variable: 'KUBECONFIG_FILE')]) {
                    sh """
                        export KUBECONFIG=$KUBECONFIG_FILE
                        
                        echo "Pods Laravel:"
                        kubectl get pods -l app=suivi-depense-budg -n $K8S_NAMESPACE
                        echo "Service Laravel:"
                        kubectl get svc suivi-depense-budg-service -n $K8S_NAMESPACE
                        echo "Ingress:"
                        kubectl get in
