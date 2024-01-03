document.getElementById('burgerMenuButton').addEventListener('click', function () {
    document.getElementById('burgerMenu').classList.toggle('hidden');
});

document.getElementById('closeBurgerMenu').addEventListener('click', function () {
    document.getElementById('burgerMenu').classList.add('hidden');
});

