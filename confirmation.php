<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .confirmation-container h1 {
            color: #007bff;
        }
        .confirmation-container p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .confirmation-container .btn-primary {
            font-size: 16px;
        }

        div.button a{
            text-decoration: none;
            color: black;
            border: 2px solid #000;
            padding: 5px 10px;
            position: relative;
            overflow:hidden;
        }

        a.btn::after{
            content: "";

            width: 100%;
            height: 100%;

            background-color: black;

            position: absolute;
            top: 0;
            left: 0;

            z-index: -1;

            transform: translateX(-100%);
            transition: all .25s;

        }

        a.btn:hover{
            color: #fff;
        }

        a.btn:hover::after{

            transform: translateY(0%);
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h1 style="color:black;">Application Successfully Submitted!</h1>
        <p>Thank you for your application. Your submission has been received and is being processed.</p>
        <div class="button">
            <a href="index.html" class="btn">Submit Again</a>
        </div>
        
    </div>
</body>
</html>
