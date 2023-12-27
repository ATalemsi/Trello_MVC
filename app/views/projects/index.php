<?php require APPROOT . '/views/inc/header.php'; ?>
<main class="flex-1">
        <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Project</h1>
                <?php flash('project_message') ;?>
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
                            <div class="p-6 pt-0">
                                <a href="<?php echo URLROOT; ?>/projects/edit/<?php echo $project->projectID ?>" class=" block w-full select-none rounded-lg text-white bg-blue-700 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Modifier</a>
                            </div>
                            <div class="p-6 pt-0">
                            <a href="<?php echo URLROOT; ?>/projects/delete/<?php echo $project->projectID ; ?>" class="cursor-pointer block w-full select-none rounded-lg text-white bg-rose-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" > delete</a>
                            </div>
                            <div class="p-6 pt-0">
                                <a href="<?php echo URLROOT; ?>/tasks/index/<?php echo $project->projectID ?>" class=" block w-full select-none rounded-lg text-white bg-green-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">View Task</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
    </div>
  </div>
</main>
<?php require APPROOT . '/views/inc/footer.php';   ?>