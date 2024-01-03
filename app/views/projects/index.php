<?php require APPROOT . '/views/inc/header.php'; ?>

<style>
    .card-container {
        perspective: 1000px;
    }

    .card {
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transition: transform 0.5s;
    }

    .card-inner {
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transition: transform 0.5s;
    }

    .card-front,
    .card-back {
        width: 100%;
        height: 100%;
        position: absolute;
        backface-visibility: hidden;
    }

    .card-back {
        transform: rotateY(180deg);
    }
</style>


<main class="flex-1">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Project</h1>
            <?php flash('project_message'); ?>
            <a href="<?php echo URLROOT; ?>/projects/add" class="px-4 py-2 bg-blue-500 text-white rounded-md">+Add Project</a>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-center gap-12">
            <?php foreach ($data['projects'] as $project) : ?>
                <?php if ($project->user_id == $_SESSION['user_id']) : ?>
                    <div class="relative w-80 h-48 card-container">
                        <div class="card">
                            <div class="card-inner">
                                <div class="card-front bg-white shadow-md rounded-xl p-6">
                                    <!-- Front content here -->
                                    <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900"><?= $project->project_name ?></p>
                                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700 opacity-75">
                                        CREATED BY: <?php echo $project->Nom ?>
                                    </p>
                                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700 opacity-75">
                                        ON: <?php echo $project->created_at; ?>
                                    </p>

                                    <div class="flex mt-4">
                                        <div class="pt-0">
                                            <a href="<?php echo URLROOT; ?>/projects/edit/<?php echo $project->project_id ?>" class="block  select-none rounded-lg text-blue  py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fas fa-edit  text-blue-500 text-xl"></i>
                                            </a>
                                        </div>

                                        <div class="pt-0">
                                            <a href="<?php echo URLROOT; ?>/projects/delete/<?php echo $project->project_id; ?>" class="cursor-pointer block  select-none rounded-lg   py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fas fa-trash-alt text-red-500 text-xl"></i>
                                            </a>
                                        </div>

                                        <div class="pt-0">
                                            <a href="<?php echo URLROOT; ?>/tasks/index/<?php echo $project->project_id ?>" class="block w-full select-none rounded-lg py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fas fa-tasks text-green-700 text-xl"></i>
                                            </a>
                                        </div>

                                        <div class="pt-0">
                                            <button class="block w-full select-none rounded-lg py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85]" onclick="toggleCard(this)">
                                                <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="card-back bg-white shadow-md rounded-xl p-6">
                                    <!-- Back content here -->
                                    <h2 class="text-xl font-semibold text-gray-900"><?php echo $project->project_name; ?> Statistics</h2>
                                    <p>Total Tasks: <?php echo $project->total_tasks; ?></p>
                                    <p>Completed Tasks: <?php echo $project->completed_tasks; ?></p>
                                    <p>Todo Tasks: <?php echo $project->todo_tasks; ?></p>
                                    <p>Doing Tasks: <?php echo $project->doing_tasks; ?></p>
                                    <p>Percentage Completion: <?php echo $project->percentage_completion; ?>%</p>

                                    
                                    <div class="pt-0">
                                        <button class="mt-2 block w-full select-none rounded-lg py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85]" onclick="toggleCard(this)">
                                            fack you man
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<script>
 function toggleCard(element) {
        const cardContainer = element.closest('.card-container');
        const cardInner = cardContainer.querySelector('.card-inner');

        cardInner.style.transform = cardInner.style.transform === 'rotateY(180deg)' ? 'rotateY(0deg)' : 'rotateY(180deg)';
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
