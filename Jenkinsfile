pipeline{
    agent any
    stages{

        stage("SCM Checkout"){
            steps{
                checkout([$class: 'GitSCM', branches: [[name: '*/main']], doGenerateSubmoduleConfigurations: false, extensions: [[$class: 'CleanBeforeCheckout', deleteUntrackedNestedRepositories: true]], submoduleCfg: [], userRemoteConfigs: [[credentialsId: 'trivy-pipeline', url: 'https://github.com/pancaperkasa/presentasi-ci.git']]])
            }
        }

        stage("Misconfig Scanner"){
            steps{
                sh '''
                mkdir /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/
                touch /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportconfig.html
                trivy config . --format template --template "@html.tpl" -o /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportconfig.html --exit-code 0 --severity MEDIUM,HIGH,CRITICAL
                trivy config . --format json -o /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportconfig.json --exit-code 0 --severity MEDIUM,HIGH,CRITICAL
                '''
            }
        }

        stage('Filesystem Scanner') {
            steps {
                sh """
                touch /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportfs.html
                trivy fs fs_test/  --format template --template "@html.tpl" -o /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportfs.html --exit-code 0 --severity MEDIUM,HIGH,CRITICAL
                trivy fs fs_test/ --format json -o /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportfs.json --exit-code 0 --severity MEDIUM,HIGH,CRITICAL
                """
            }
        }

        stage('Create Image') {
            steps {
                sh """
                docker build --no-cache -t presentasitest:v${BUILD_NUMBER} .
                """
            }
        }
        
        stage("Vulnerability and Secret Scanner"){
            steps{
                sh '''
                touch /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportvulnimage.html
                trivy image --format template --template "@html.tpl" -o /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportvulnimage.html --exit-code 0 --severity MEDIUM,HIGH,CRITICAL presentasitest:v${BUILD_NUMBER}
                trivy image --format json -o /var/www/html/trivy-ci/pipeline${BUILD_NUMBER}/reportvulnimage.json --exit-code 0 --severity MEDIUM,HIGH,CRITICAL presentasitest:v${BUILD_NUMBER}
                '''
            }
        }
      
    }
}
