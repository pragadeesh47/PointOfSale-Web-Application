// let activeLink = document.querySelector(".active-link");
let links = document.querySelectorAll(".link");
window.addEventListener("load", function (){
    let url = window.location.href;
    if(url.includes("dashboard")){
        url = "sale";
    }
    links.forEach(link => {
        console.log(url);
        toConvertLower = String(link.textContent);
        toConvertLower = toConvertLower.toLowerCase();
        link.classList.remove("active-link");
        if(url.includes(toConvertLower)){
            link.classList.add("active-link");
        }
    });

})



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
  var logModal = document.getElementById('id02');

  // When the user clicks anywhere outside of the logModal, logClose it
  window.onclick = function(event) {
    if (event.target == logModal) {
      logModal.style.display = "none";
    }
  }





//   function ExportToExcel(type, fn, dl) {
//     var elt = document.getElementById('exportData');
//     var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
//     return dl ?
//       XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
//       XLSX.writeFile(wb, fn || ('data.' + (type || 'xlsx')));
// }



var month = d.getMonth()+1;
var day = d.getDate();
    
var output = d.getFullYear() + '-' +(month<10 ? '0' : '') + month + '-' +(day<10 ? '0' : '') + day;
document.getElementById("fromDate").value = output;
document.getElementById("toDate").value = output;



console.log("hei")

document.querySelector(".deletebtn").onclick = () =>{
  localStorage.clear();
}



