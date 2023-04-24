const form1 = document.getElementById("form-submit");
const form2 = document.getElementById("form-filter");
const filterBtn = document.getElementById("filter-btn");
const showBtn = document.getElementById("show-btn");
let table = document.getElementById("exportData");
const hideBtn = document.getElementById("hide-btn");
const updateBtn = document.getElementById("update-btn");


const fromDate = document.getElementById("fromDate"),
toDate = document.getElementById("toDate");
document.getElementById("expense-submit").onsubmit = (e) =>{
    e.preventDefault();
    console.log("hello");
  }
  


form1.onsubmit = (e) => {
    e.preventDefault();
} 
form2.onsubmit = (e) => {
    e.preventDefault();
} 

// showBtn.onclick = () => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","displayexpense.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 total =  data.split(".")
//                 table.innerHTML = total[0];
//                 console.log(data);
//                 document.querySelector(".outputFields").classList.add("show");
//                 document.querySelector(".amount").textContent = total[1];
//             }
//         }
//     }
    
//     xhr.send();
// };
// hideBtn.onclick = ()=>{
//     document.querySelector(".outputFields").classList.remove("show");
// }

// filterBtn.onclick = () => {
//     if(fromDate.value !="" && toDate.value!=""){
//         let xhr = new XMLHttpRequest();
//         xhr.open("POST","displayexpense.php",true);
//         xhr.onload = () =>{
//             if(xhr.readyState === XMLHttpRequest.DONE){
//                 if(xhr.status === 200){
//                     let data = xhr.response;
//                     total =  data.split(".")
//                     table.innerHTML = total[0];
//                     // document.querySelector(".outputFields").classList.add("show");
//                     $(".outputFields").show();
//                     document.querySelector(".amount").textContent = total[1];
//                     fromDate.value=""; 
//                     toDate.value="";
//                 }
//             }
//         }
//         let formData = new FormData(form2);
//         xhr.send(formData);
//     }
//     else{
//         alert("Required Fields are missing");
//     }
  
// };


const item = document.getElementById("item");
const price = document.getElementById("price");


// updateBtn.onclick = () => {
//     if(item.value !=""){
//         console.log("Hellooo");
//     }
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","expenseupdate.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 if(data === "success"){
//                    console.log("hello");
//                 }
//                 else{
                   
//                     console.log(data);
//                     console.log("hii");
//                     var itemField = document.getElementById("item").value = "";
//                     var priceField = document.getElementById("price").value="";
//                 }
//             }
//         }
//     }
//     let formData = new FormData(form1);
//     xhr.send(formData);
// };

  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }

  var customerSubmitBtn = document.getElementById("customer-submit-btn");
  customerSubmitBtn.onclick = function (){
    modal.style.display = "none";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

