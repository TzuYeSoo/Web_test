const newunif_btn = document.querySelector("#creatsupplier");
const modal = document.querySelector(".modal");    
const backdrop = document.querySelector(".backdrop");   

newunif_btn.addEventListener('click', ()=>{
    modal.style.display = 'block';
    backdrop.style.display = 'block';
});