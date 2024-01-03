<?php require APPROOT . '/views/inc/header.php'; ?>
<main class="flex-1">
        <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Tasks</h1>          
                <form method="post" action="<?php echo URLROOT; ?>/tasks/search" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4 flex items-center">
                        <input type="text" name="search_query" placeholder="Search tasks" class="py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Search</button>
                </form>
                <?php 
                        function getIdFromUrl() {
                            $url = $_SERVER['REQUEST_URI'];
                            $parts = explode('/', $url);
                            $projectId = end($parts);

                            return $projectId;
                        }

                        $projectId = getIdFromUrl();
                        $tasks = $data['tasks'];

                        // Check if the project has tasks
                        if (!empty($tasks) && !empty($tasks[0]->project_id)) {
                            $projectId = $tasks[0]->project_id;
                        }

                            ?>
                <a href="<?php echo URLROOT.'/tasks/add/' . $projectId;  ?> " class="px-4 py-2 bg-blue-500 text-white rounded-md"> +Add Tasks</a>
                <?php  ?>
            </div>
             <?php flash('tasks_message');?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4">
             <h2 class="text-2xl font-semibold text-blue-600">TO DO</h2>                   
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-center gap-6">
                
                <?php foreach ($data['tasks'] as $task): ?>
                    <?php if ($task->status == 'To do'  && $task->Archive == 1): ?>
                        <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-80 rounded-xl bg-clip-border">
                            <div class="p-6">
                                <div class="mb-4">
                                    <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900"><?= $task->task_name ?></p>
                                </div>
                                <div class="mb-4">
                                    <p class="block font-sans text-sm antialiased font-bold leading-normal text-gray-700 opacity-75">
                                        Date de debut: <?php echo $task->debut_date; ?> 
                                    </p>

                                </div>
                                <div class="mb-4">
                                    <p class="block font-sans text-sm antialiased font-bold leading-normal text-gray-700 opacity-75">
                                       Date de fin:  <?php echo  $task->fin_date;?>
                                    </p>
                                    
                                </div>
                                <div class="p-6 pt-0">
                                    <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $task->task_id ;?>" class=" block w-full select-none rounded-lg text-white bg-blue-700 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Modifier</a>
                                </div>
                                <div class="p-6 pt-0">
                                <a href="<?php echo URLROOT; ?>/tasks/delete/<?php echo $task->task_id ; ?>" class="cursor-pointer block w-full select-none rounded-lg text-white bg-rose-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" >Archive</a>
                                </div>
                                <div class="p-6 pt-0">
                                    <a href="<?php echo URLROOT; ?>/tasks/etat/<?php echo $task->task_id ;?>" class=" block w-full select-none rounded-lg text-white bg-green-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Edit Etat</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4">
             <h2 class="text-2xl font-semibold text-blue-600">DOING</h2>                   
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-center gap-6">
                
                <?php foreach ($data['tasks'] as $task): ?>
                    <?php if ($task->status == 'Doing'  && $task->Archive==1  ): ?>
                        <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-80 rounded-xl bg-clip-border">
                            <div class="p-6">
                                <div class="mb-4">
                                    <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900"><?= $task->task_name ?></p>
                                </div>
                                <div class="mb-4">
                                    <p class="block font-sans text-sm antialiased font-bold leading-normal text-gray-700 opacity-75">
                                        Date de debut: <?php echo $task->debut_date; ?> 
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <p class="block font-sans text-sm antialiased font-bold leading-normal text-gray-700 opacity-75">
                                       Date de fin:  <?php echo  $task->fin_date;?>
                                    </p>
                                    
                                </div>
                                <div class="p-6 pt-0">
                                    <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $task->task_id ?>" class=" block w-full select-none rounded-lg text-white bg-blue-700 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Modifier</a>
                                </div>
                                <div class="p-6 pt-0">
                                <a href="<?php echo URLROOT; ?>/tasks/delete/<?php echo $task->task_id ; ?>" class="cursor-pointer block w-full select-none rounded-lg text-white bg-rose-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" >Archive</a>
                                </div>
                                <div class="p-6 pt-0">
                                    <a href="<?php echo URLROOT; ?>/tasks/etat/<?php echo $task->task_id ?>" class=" block w-full select-none rounded-lg text-white bg-green-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Edit Etat</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4">
             <h2 class="text-2xl font-semibold text-blue-600">DONE</h2>                   
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-center gap-6">
                
                <?php foreach ($data['tasks'] as $task): ?>
                    <?php if ($task->status == 'Done'  && $task->Archive==1 ): ?>
                        <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-80 rounded-xl bg-clip-border">
                            <div class="p-6">
                                <div class="mb-4">
                                    <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900"><?= $task->task_name ?></p>
                                </div>
                                <div class="mb-4">
                                    <p class="block font-sans text-sm antialiased font-bold leading-normal text-gray-700 opacity-75">
                                        Date de debut: <?php echo $task->debut_date; ?> 
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <p class="block font-sans text-sm antialiased font-bold leading-normal text-gray-700 opacity-75">
                                       Date de fin:  <?php echo  $task->fin_date;?>
                                    </p>
                                    
                                </div>
                                <div class="p-6 pt-0">
                                    <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $task->task_id ?>" class=" block w-full select-none rounded-lg text-white bg-blue-700 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Modifier</a>
                                </div>
                                <div class="p-6 pt-0">
                                <a href="<?php echo URLROOT; ?>/tasks/delete/<?php echo $task->task_id ; ?>" class="cursor-pointer block w-full select-none rounded-lg text-white bg-rose-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" >Archive</a>
                                </div>
                                <div class="p-6 pt-0">
                                    <a href="<?php echo URLROOT; ?>/tasks/etat/<?php echo $task->task_id ?>" class=" block w-full select-none rounded-lg text-white bg-green-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Edit Etat</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require APPROOT . '/views/inc/footer.php';   ?>