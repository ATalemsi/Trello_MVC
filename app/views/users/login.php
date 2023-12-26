<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            @apply bg-cover bg-center bg-fixed;
            background-image: linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(117, 19, 93, 0.73)),
            url('img/data-warehousen.jpg');
            
        }
    </style>
    <title>Login Page</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
       <?php flash('register_success'); ?>
        <!-- Login Form -->
        <form id="login-form" action="<?php echo URLROOT; ?>/users/login" method="post">
          
            <img src="<?php echo URLROOT?>/public/img/black.png" alt="Logo" class="mx-auto mb-8 rounded-full w-32 h-20">
            <div class="mb-4">
                <label for="email" class="block text-gray-600 text-sm font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500   <?php echo (!empty($data['email_error'])) ? 'invalid:border-red-500 ' : '';?>" value="<?php echo $data['email']?>" placeholder="john.doe@example.com">
                <span class="mt-2  text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block"><?php echo $data['email_error'];?></span>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 <?php echo (!empty($data['password_error'])) ? 'invalid:border-red-500 ' : '';?>" value="<?php echo $data['password']?>" placeholder="********" >
                <span class="mt-2  text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block"><?php echo $data['password_error'];?></span>
            </div>
            <button type="submit" value="Login" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200">
                Login
            </button>
            <p class="mt-4 text-sm text-gray-600">Don't have an account? <a href="<?php echo URLROOT; ?>/users/register" id="show-signup" class="text-blue-700 font-bold">Sign up</a></p>
        </form>
    </div>
</body>
</html>
