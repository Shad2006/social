let visible = document.getElementById('visible');
function view(){
    let field =  document.getElementById('password');
    field.setAttribute('type', 'text');

}
visible.addEventListener('click', view)