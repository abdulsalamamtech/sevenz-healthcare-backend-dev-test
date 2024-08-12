# sevenz-healthcare-backend-dev-test

Authenticated and authorized users (i.e doctors) can access and update patient medical records

## Register

- data
```json
    {
        "name" : "abdulsalam abdulrahman",
        "email" : "abdulsalamamtech@gmail.com",
        "paassword" : "password"
    }
```
-response
```json
    {
    "success": "true",
    "message": "User account created successfully",
    "user": {
        "name": "abdulsalam abdulrahman",
        "email": "abdulsalamamtech@gmail.com",
        "username": "abdulsalam abdulrahman92",
        "role": "doctors",
        "updated_at": "2024-08-11T21:27:26.000000Z",
        "created_at": "2024-08-11T21:27:26.000000Z",
        "id": 11
    },
    "access_token": "1|tBzu6NZekPXGimQwJHyKx9nICBFIUAsbB2s3jmUq14640d84",
    "token_type": "Bearer"
    }
```

## Login
```json
    {
        "email" : "abdulsalamamtech@gmail.com",
        "paassword" : "password"
    }
```

## Get patient medical records
Authorizer: doctors or nurses
Token: "1|tBzu6NZekPXGimQwJHyKx9nICBFIUAsbB2s3jmUq14640d84"
- authorization: Bearer token
- data
```json
    {
        "user_id" : 8
    }
```




## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Abdulsalam Abdulrahman via [abdulsalamamtech@gmail.com](mailto:abdulsalamamtech@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
