# AWS Secrets Helper

A PHP helper function to retrieve secret values from AWS Secrets Manager with caching in Redis.

## Description

This helper function `awsSecret` allows you to securely fetch secret values from AWS Secrets Manager and cache them in Redis for improved performance. This is particularly useful for reducing the number of requests to AWS Secrets Manager and speeding up your application.

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/luv-vik/aws-secrets-helper.git
    cd aws-secrets-helper
    ```

2. **Install dependencies:**

    Make sure you have Composer installed. Then, run:

    ```sh
    composer install
    ```

3. **Configuration:**

    Ensure you have the following environment variables set in your project:

    - `REDIS_HOST`: The hostname of your Redis server.
    - `REDIS_PORT`: The port number of your Redis server.
    - `AWS_DEFAULT_REGION`: The AWS region where your secrets are stored.
    - `AWS_SECRET_ARN`: The ARN of the AWS secret you want to retrieve.

## Usage

Include the helper function in your project and call it as needed:

```php

$mySecret = awsSecret('my-secret-key', 'default-value');

echo $mySecret;
