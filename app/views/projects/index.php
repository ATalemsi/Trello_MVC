<?php require APPROOT . '/views/inc/header.php'; ?>
<main class="flex-1">
        <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Project</h1>
                <a href="<?php echo URLROOT; ?>/projects/add" class="px-4 py-2 bg-blue-500 text-white rounded-md"> +Add Project</a>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-center gap-6">
                
            <?php foreach ($data['projects'] as $project): ?>
                <?php if ($project->user_id == $_SESSION['user_id']): ?>
                    <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-80 rounded-xl bg-clip-border">
                        <div class="p-6">
                            <div class="mb-4">
                                <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900"><?= $project->project_name ?></p>
                            </div>
                            <div class="mb-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700 opacity-75">
                                    CREATED BY: <?php echo $project->Nom ?> 
                                </p>
                            </div>
                            <div class="mb-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700 opacity-75">
                                   ON:  <?php echo  $project->created_at;?>
                                </p>
                            </div>
                            <div class="mb-4">
                                <a href="<?php echo URLROOT; ?>/projects/show/<?php echo $project->projectID ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">More</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
    </div>
  </div>
</main>
<?php require APPROOT . '/views/inc/footer.php';   ?>