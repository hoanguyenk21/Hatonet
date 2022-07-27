pipeline {
    agent any
    stages {
        stage('Deploy') {
            steps {
                sshagent(['smc-key']) {
                    sh "scp -prq ./** root@103.199.17.145:/home/hatonet/"
                }
            }
        }
        stage('Build') {
            steps {
                sshagent(['smc-key']) {
                    // some block
                    sh "ssh -o StrictHostKeyChecking=no root@103.199.17.145 -f 'cd /home/hatonet/ && sh ./deploy.sh'"
                }
            }
        }
    }
}