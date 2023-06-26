import config from "../config.js";

let componet = await config.phatname(import.meta.url)


export default {
    name: componet[2],
    componet() {
        this.name = class extends HTMLElement {
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


                let response = await fetch("http://localhost/admin-site/cities", {
                    method: "GET",
                    headers: headersList
                });

                let data = await response.json();
                console.log(data);
                let plantilla_country = ''
                let plantilla_tb = ''
                data.Message.forEach((item) => {

                    plantilla_tb += `
                    
                    <tr>
                        <td>${item.name_city}</td>
                        <td>${item.name_region}</td>
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

                let response_counrty = await fetch("http://localhost/admin-site/regions", {
                    method: "GET",
                    headers: headersList
                });
                data = await response_counrty.json();
                data.Message.forEach((item) => {

                    plantilla_country += `
                        <option value="${item.id}">${item.name_region}</option>
                    `
                });

                this.querySelector('#region').innerHTML = plantilla_country;
                this.querySelector('#data-get').innerHTML = plantilla_tb;
            }

            async delete(item) {
                let headersList = {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
                console.log(item.id);
                let response = await fetch(`http://localhost/admin-site/cities/${item.id}`, {
                    method: "DELETE",
                    headers: headersList
                });

                let data = await response.json();
                data.Message == "Done" ? alert(`item eliminado con exito`) : alert(`item no puedo ser eliminador`);

                this.drawtable();
            }

            async put(cities, region, id) {
                let headersList = {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }

                let bodyContent = JSON.stringify({
                    "name_city": cities,
                    "region": region
                });

                let response = await fetch(`http://localhost/admin-site/cities/${id}`, {
                    method: "PUT",
                    body: bodyContent,
                    headers: headersList
                });

                let res = await response.json();

                console.log(res);

                res.Code == 200 ? alert(`item actualizado con exito`) : alert(`item no puedo ser actualizado`);

                this.drawtable();
            }

            edit(item) {

                let select_country = this.querySelector('select');

                let country = select_country.cloneNode(true);

                let row = document.elementFromPoint(item.clientX, item.clientY).parentNode.parentNode.parentNode.parentNode
                row.querySelectorAll('td')[0].innerHTML = `<input type="text" value="${row.querySelectorAll('td')[0].textContent}" class="form-control" ></input>`
                row.querySelectorAll('td')[1].innerHTML = '';
                row.querySelectorAll('td')[1].appendChild(country);


                item.target.innerHTML = `
                    <button data-status="ok">
                        OK
                        <i class='bx bx-check'></i>
                    </button>
                
                `
                row.querySelectorAll("[data-name='delete']")[0].dataset.name = 'close';
                row.querySelectorAll("[data-name='close']")[0].addEventListener("click", () => {
                    this.drawtable();
                })

                this.querySelector("button[data-status]").addEventListener("click", (e) => {
                    e.target.dataset.status === 'ok' ? this.put(row.querySelector('input').value, row.querySelector('select').value, item.target.dataset.id) : null;
                    e.target.dataset.name === 'delete' ? this.drawtable() : null;
                })


            }

            async acction() {
                this.querySelector("#data-get").addEventListener("click", (e) => {
                    e.target.dataset.name === 'delete' ? this.delete(e.target.dataset) : null;
                    e.target.dataset.name === 'edit' ? this.edit(e) : null;
                })
            }

            async connectedCallback() {

                //post
                this.querySelector('#my-from').addEventListener('submit', async (e) => {
                    e.preventDefault();
                    let data = Object.fromEntries(new FormData(e.target));
                    console.log(data);

                    let headersList = {
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    }
                    console.log(data);


                    let response = await fetch("http://localhost/admin-site/cities", {
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