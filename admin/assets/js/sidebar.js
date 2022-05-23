const navbtn = document.querySelector('.navbtn');
const wrapper = document.querySelector('.wrapper');
const sidebar = document.querySelector('#sidebar');
navbtn.addEventListener("click",()=>{
    // alert('wow');
    wrapper.classList.toggle('d-none');
  sidebar.classList.toggle('d-none');

});
window.onclick = (event)=>{
  if (event.target == wrapper) {
    wrapper.classList.toggle('d-none');
    sidebar.classList.toggle('d-none');
  }
}