var buttons = document.querySelectorAll('.acc h3');
for(let i = 0; i < buttons.length; i++){
    buttons[i].addEventListener('click', ($event) => {

        $event.target.classList.toggle('active');

        var contentPanel = $event.target.nextElementSibling;
        if(contentPanel.style.display === 'block'){
            contentPanel.style.display = 'none';
        } else {
            contentPanel.style.display = 'block';
        }

    });
}