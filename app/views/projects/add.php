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
    <title>Add Project</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen flex-col">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <form id="ajouter-teams-form" method="post" action="<?php echo URLROOT ?>/projects/add ">
            <div class="mb-4">
                <label for="project_name" class="block text-gray-600 text-sm font-semibold mb-2">project Name</label>
                <input type="text" id="project_name" name="project_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 <?php echo (!empty($data['project_name_error'])) ? 'invalid:border-red-500 ' : '';?>" value="<?php echo $data['project_name']?>" placeholder="Project Name" >
                <span class="mt-2 text-sm text-red-500 <?php echo (!empty($data['project_name_error'])) ? 'block' : 'hidden'; ?>"><?php echo $data['project_name_error']; ?></span>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200" value="Submit">
                Add Project
            </button>
        </form>
    </div>
    <a href="<?php echo URLROOT; ?>/projects" class=" text-center text-white my-8 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</a>
</body>
</html>
