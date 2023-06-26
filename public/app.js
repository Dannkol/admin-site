import mySubject from "./src/Administration/my-subject.js";
import myCountrie from "./src/Ubicacion/my-countrie.js";
import myRegions from "./src/Ubicacion/my-regions.js";
import myCities from "./src/Ubicacion/my-cities.js";
import myArea from "./src/Administration/my-area.js";
import myStaff from "./src/staff/my-staff.js";

mySubject.componet();
myCountrie.componet();
myRegions.componet();
myCities.componet();
myArea.componet();

myStaff.componet();

let vista = document.querySelector('#vista');

document.querySelectorAll('a[data-value]').forEach((item) => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
    
        vista.innerHTML = ''
      
        let newElement = `<${e.target.dataset.value}></${e.target.dataset.value}>`
      
        vista.innerHTML = newElement
      });
})
  