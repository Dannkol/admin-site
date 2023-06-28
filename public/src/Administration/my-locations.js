import config from "../config.js";

let componet = await config.phatname(import.meta.url)


export default {
    name: componet[2],
    componet() {
        this.name = class extends HTMLElement {

            url = componet[3]+'locations/'

            constructor() {
                super();

                this.innerHTML = componet[0];
            }
            static get observedAttributes() {
                return [];
            }

            handleEvent(e) {

            }

            sendMesaggerEvent(e) {
                console.log(e.target.textContent);
            }


            attributeChangedCallback(attr, oldValue, newValue) {
                // console.log(attr);
                // console.log(oldValue);
                // console.log(newValue);

            }

            async drawtable() {

               

                let headersList = {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }


                let response = await fetch(`${this.url}`, {
                    method: "GET",
                    headers: headersList
                });

                let data = await response.json();
                console.log(data);
                let plantilla = ''
                data.Message.forEach((item) => {

                    plantilla += `
                    <tr>
                        <td>${item.name_location}</td>
                        <td >
                            <div class="accion">
                                <div >
                                <button  data-id="${item.id}" data-name="edit">
                                    Edit
                                    <i  class='bx bxs-edit-alt'></i>
                                </button>
                                    
                                </div>
                                <div >
                                <button style="width: 40px;" >
                                    <h4 data-id="${item.id}"  data-name='delete'>x</h4>
                                </button>
                                </div>
                            </div>

                        </td>
                    </tr>
                    `
                });
                this.querySelector('#data-get').innerHTML = plantilla;
            }

            async delete(item) {
                let headersList = {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
                console.log(item.id);
                let response = await fetch(`${this.url}${item.id}`, {
                    method: "DELETE",
                    headers: headersList
                });

                let data = await response.json();
                data.Message == "Done" ? alert(`item eliminado con exito`) : alert(`item no puedo ser eliminador`);

                this.drawtable();
            }

            async put(data, id){
                let headersList = {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                   }
                   
                   let bodyContent = JSON.stringify({
                     "name": data
                   });
                   
                   let response = await fetch(`${this.url}${id}`, { 
                     method: "PUT",
                     body: bodyContent,
                     headers: headersList
                   });
                   
                   let res = await response.json();

                   res.Code == 200 ? alert(`item actualizado con exito`) : alert(`item no puedo ser actualizado`);
                   
                   this.drawtable();
            }

            edit(item) {

                let row = document.elementFromPoint(item.clientX, item.clientY).parentNode.parentNode.parentNode.parentNode
                row.querySelector('td').innerHTML = `<input type="text" value="" class="form-control" placeholder="${row.querySelector('td').textContent}"></input>` 
                item.target.innerHTML = `
                    <button data-status="ok">
                        OK
                        <i class='bx bx-check'></i>
                    </button>
                
                `
                row.querySelectorAll("[data-name='delete']")[0].dataset.name = 'close';
                row.querySelectorAll("[data-name='close']")[0].addEventListener("click", ()=>{
                    this.drawtable();
                })

                this.querySelector("button[data-status]").addEventListener("click", (e) => {
                    e.target.dataset.status === 'ok' ? this.put(row.querySelector('input').value,item.target.dataset.id) : null;
                    e.target.dataset.name === 'delete' ? this.drawtable(): null;
                })

                
            }

            async acction() {
                this.querySelector("#data-get").addEventListener("click", (e) => {
                    e.target.dataset.name === 'delete' ? this.delete(e.target.dataset) : null;
                    e.target.dataset.name === 'edit'? this.edit(e) : null;
                })
            }

            async connectedCallback() {

                //post
                this.querySelector('#my-subject').addEventListener('submit', async (e) => {
                    e.preventDefault();
                    let data = Object.fromEntries(new FormData(e.target));
                    console.log(data);


                    let headersList = {
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    }


                    let response = await fetch(`${this.url}`, {
                        method: "POST",
                        body: JSON.stringify(data),
                        headers: headersList
                    });

                    let fetch_data = await response.text();
                    console.log(fetch_data);
                    this.drawtable();
                })

                //get

                this.drawtable();

                this.acction();

            }
        }
        window.customElements.define(componet[1], this.name);
    }

}