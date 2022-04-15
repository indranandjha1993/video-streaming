# 1: video-streaming

`Run composer install`

<small style="color:red;">make sure to correct permission for video and key dir, and you have to install ffmpeg tool in your sysytem.</small>

<p> Currently user authentication and autherization has not been created yet</p>



# 2: AWS infrastructure CI/CD

1) GitHub Actions – Workflow Orchestration tool that will host the Pipeline.
2) AWS CodeDeploy – AWS service to manage deployment on Amazon EC2 Autoscaling Group.
3) AWS Auto Scaling – AWS Service to help maintain application availability and elasticity by automatically adding or removing Amazon EC2 instances.
4) Amazon EC2 – Destination Compute server for the application deployment.
5) AWS CloudFormation – AWS infrastructure as code (IaC) service used to spin up the initial infrastructure on AWS side.
6) AWS Load Balancer - This service will take care of Blue/Green Deployments as well as traffic distrubution
6) IAM OIDC identity provider – Federated authentication service to establish trust between GitHub and AWS to allow 7) GitHub Actions to deploy on AWS without maintaining AWS Secrets and credentials.
8) Amazon Simple Storage Service (Amazon S3) – Amazon S3 to store the deployment artifacts.


    ![CI/CD Architecture Diagram](https://github.com/indranandjha1993/images/blob/main/1-ArchitectureDiagram.png?raw=true)


## Reference
 - [Achive CI / CD with autoscaling](https://aws.amazon.com/blogs/devops/integrating-with-github-actions-ci-cd-pipeline-to-deploy-a-web-app-to-amazon-ec2/)

