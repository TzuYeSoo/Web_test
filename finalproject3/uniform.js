const newunif_btn = document.querySelector("#createUnif");
const modal = document.querySelector("#clothesModal");    
const backdrop = document.querySelector(".backdrop");   

newunif_btn.addEventListener('click', ()=>{
    modal.style.display = 'block';
    backdrop.style.display = 'block';
});


let id, name, stock;
const currentstock = document.querySelector("#currentstock");
const unif_name = document.querySelector("#unif_name");

function editModal() {

    document.getElementById("stockin_modal").style.display = 'block'; 
    document.getElementById("backdrop").style.display = 'block';
}



function removemodal_unif(){
    modal.style.display = 'none';
    backdrop.style.display = 'none';

}

function removemodal_stock(){
    document.getElementById("stockModal").style.display = 'none'; 
    document.getElementById("backdrop").style.display = 'none';
}



