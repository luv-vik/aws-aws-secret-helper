<?php

use Predis\Client as Redis;

if(!function_exists('awsSecret')) {
    function awsSecret($key, $default = null) {
        
        if(!empty($key) && $key!==null) {
            $redis = new Redis([
                'schema' => 'tcp',
                'host' => env('REDIS_HOST'),
                'port' => env('REDIS_PORT')
            ]);
            
            $cache = $redis->get('aws-secrets');
            
            if ($cache !== null) {
                $secretData = json_decode($cache, true);
                return $secretData[$key] ?? $default;
            } else {
                $secretsManager = new \Aws\SecretsManager\SecretsManagerClient([
                    'region' => env('AWS_DEFAULT_REGION'),
                    'version' => 'latest',
                ]);
    
                try {
                    $result = $secretsManager->getSecretValue([
                        'SecretId' => env('AWS_SECRET_ARN'),
                    ]);
    
                    $secretData = json_decode($result['SecretString'], true);
                    
                    // Store the secret in Redis for caching
                    $redis->set('aws-secrets', json_encode($secretData));
    
                    return $secretData[$key] ?? $default;
                } catch (\Aws\Exception\AwsException $e) {
                    return $default;
                }
            }
        }
    }
}