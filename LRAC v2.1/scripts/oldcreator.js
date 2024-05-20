var canExit = false;

document.addEventListener("DOMContentLoaded", () => {
    var curPage = 1;
    var visitedPages = [false, false, false, false, false, false];
    var chosen_values = ["", "", "", "", ""];
    var previousSelected = ["", "", "", "", ""];
    var new_cakecode = ["", "", "", "", ""];
    var total = 0;

    var op_obj = null;
    var prev_opobj = null;

    //access like this: optionPrices.option_size[num].p/l/i
    const optionPrices = {
        option_size: [
            {},

            {
                p: 20000,
                l: 'Pastel de 1/4 de libra',
                i: 'Molde de pastel de 1/4 de libra',
                c: "1"
            },

            {
                p: 35000,
                l: 'Pastel de 1/2 de libra',
                i: 'Molde de pastel de 1/2 de libra',
                c: "2"
            },

            {
                p: 50000,
                l: 'Pastel de 1 libra',
                i: 'Molde de pastel de 1 libra',
                c: "3"
            },
        ],

        option_flavor: [
            {},

            {
                p: 2000,
                l: 'Bizcocho con sabor a Zanahoria',
                i: 'Zanahorias ralladas, Harina de trigo, Azúcar, Mantequilla, Huevos, Levadura en polvo, Canela en polvo',
                c: "1"
            },

            {
                p: 3000,
                l: 'Bizcocho con sabor a Chocolate',
                i: 'Harina de trigo, Azucar, Cacao en polvo, Mantequilla, Huevos, levadura en polvo, esencia de vainilla',
                c: "2"
            },

            {
                p: 4000,
                l: 'Bizcocho con sabor a Naranja con semillas de amapola',
                i: 'Harina de trigo, azúcar, zumo de naranja, mantequilla, huevos, levadura en polvo, semillas de amapola, ralladura de naranja',
                c: "3"
            },

            {
                p: 4000,
                l: 'Bizcocho con sabor a Vainilla',
                i: 'Harina de trigo, azucar, mantequilla, huevos, levadura en polvo, esencia de vainilla',
                c: "4"
            },

            {
                p: 3000,
                l: 'Bizcocho con sabor a Red Velvet',
                i: 'Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, cacao en polvo, colorante rojo, vinagre blanco, bicarbonato de sodio, esencia de vainilla',
                c: "5"
            },


            {
                p: 3000,
                l: 'Bizcocho con sabor a Limón',
                i: 'Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, ralladura de limón, zumo de limón',
                c: "6"
            },
        ],

        option_filling: [
            {
                p: 0,
                l: 'Sin relleno',
                i: 'Sin relleno',
                c: "0"
            },

            {
                p: 1000,
                l: "Con relleno de Crema pastelera de Limón",
                i: "Leche, yemas de huevo, azúcar, maicena, ralladura de limón",
                c: "1"
            },

            {
                p: 1000,
                l: "Con relleno de Crema pastelera de Naranja",
                i: "Leche, yemas de huevo, azúcar, maicena, ralladura de naranja",
                c: "2"
            },

            {
                p: 1000,
                l: "Con relleno de Crema pastelera de Vainilla",
                i: "Leche, yemas de huevo, azúcar, maicena, extracto de vainilla, rama de vainilla",
                c: "3"
            },

            {
                p: 2000,
                l: "Con relleno dulce de Crema chantilly",
                i: "Crema de leche, azúcar glass, esencia de vainilla",
                c: "4"
            },

            {
                p: 5000,
                l: "Con relleno dulce de Crema de arándanos",
                i: "Arándanos, crema de leche, azúcar",
                c: "5"
            },

            {
                p: 4000,
                l: "Con relleno dulce de Ganache de chocolate",
                i: "Chocolate negro, leche condensada, crema de leche, azúcar",
                c: "6"
            },

            {
                p: 4000,
                l: "Con relleno dulce de Crema de chocolate",
                i: "Chocolate negro, leche, azúcar",
                c: "7"
            },

            {
                p: 1000,
                l: "Con relleno de Mermelada de Fresa",
                i: "Mermelada de fresa",
                c: "8"
            },

            {
                p: 1000,
                l: "Con relleno de Mermelada de Mora",
                i: "Mermelada de mora",
                c: "9"
            },

            {
                p: 1000,
                l: "Con relleno de Mermelada de Frutos rojos",
                i: "Mermelada de frutos rojos",
                c: "10"
            },

            {
                p: 1000,
                l: "Con relleno de Mermelada de Mango",
                i: "Mermelada de mango",
                c: "11"
            },

            {
                p: 1000,
                l: "Con relleno de Mermelada de Naranja",
                i: "Mermelada de naranja",
                c: "12"
            },
        ],

        option_cover: [
            {
                p: 0,
                l: "Sin cobertura",
                i: "Sin cobertura",
                c: "0"
            },

            {
                p: 4000,
                l: "Cubierto de Buttercream",
                i: "Mantequilla, azucar glass, leche, esencia de vainilla",
                c: "1"
            },

            {
                p: 5000,
                l: "Cubierto de Chocolate Negro",
                i: "Chocolate negro, mantequilla, crema de leche",
                c: "2"
            },

            {
                p: 5000,
                l: "Cubierto de Chocolate Blanco",
                i: "Chocolate blanco, mantequilla, crema de leche",
                c: "3"
            },

            {
                p: 6000,
                l: "Cubierto de Crema Chantilly",
                i: "Crema de leche, azúcar glass, esencia de vainilla",
                c: "4"
            },

            {
                p: 4000,
                l: "Cubierto de Fondant Blanco",
                i: "Fondant blanco (azúcar glass y agua)",
                c: "5"
            },
        ],

        option_border: [
            {
                p: 0,
                l: "Sin bordeado",
                i: "Sin bordeado",
                c: "0"
            },

            {
                p: 2000,
                l: "Bordeado de Crema Chantilly",
                i: "Crema chantilly",
                c: "1"
            },

            {
                p: 3000,
                l: "Bordeado de Oreos",
                i: "Oreos normales",
                c: "2"
            },

            {
                p: 4000,
                l: "Bordeado de M&Ms",
                i: "M&Ms de chocolate",
                c: "3"
            },

            {
                p: 2000,
                l: "Bordeado de Pepitas de Chocolate",
                i: "Pepitas de chocolate",
                c: "4"
            },

            {
                p: 1000,
                l: "Bordeado de Chispas de Colores",
                i: "Chispas de colores",
                c: "5"
            },

            {
                p: 3000,
                l: "Bordeado de Fresas",
                i: "Fresas frescas",
                c: "6"
            },
        ]
    };

    const price = document.getElementById("price");

    const input = document.getElementById("cake_params");
    const next_bt = document.getElementById("option_next");
    const back_bt = document.getElementById("option_back");

    const finish_bt = document.getElementById("option_finish");
    const createConfirm = document.getElementById("createConfirm");
    const closedialog = document.getElementById("closeCrCf");

    const cakedesc = document.getElementById("cakedesc");
    const cakeprice = document.getElementById("cakeprice");
    const cakeimg = document.getElementById("cakeimg");
    const cakeing = document.getElementById("cakeing");

    //CakeDesc = cd
    var cd_size = null;
    var cd_flavor = null;
    var cd_filling = null;
    var cd_cover = null;
    var cd_border = null;


    const cc_contOptions_p1 = document.getElementById("cc_contOptions_p1");
    const buttons1 = cc_contOptions_p1.querySelectorAll(".cc_button")

    const cc_contOptions_p2 = document.getElementById("cc_contOptions_p2");
    const buttons2 = cc_contOptions_p2.querySelectorAll(".cc_button")

    const cc_contOptions_p3 = document.getElementById("cc_contOptions_p3");
    const buttons3 = cc_contOptions_p3.querySelectorAll(".cc_button")

    const cc_contOptions_p4 = document.getElementById("cc_contOptions_p4");
    const buttons4 = cc_contOptions_p4.querySelectorAll(".cc_button")

    const cc_contOptions_p5 = document.getElementById("cc_contOptions_p5");
    const buttons5 = cc_contOptions_p5.querySelectorAll(".cc_button")

    const cc_cont_p1 = document.getElementById("cc_cont_p1");
    const cc_cont_p2 = document.getElementById("cc_cont_p2");
    const cc_cont_p3 = document.getElementById("cc_cont_p3");
    const cc_cont_p4 = document.getElementById("cc_cont_p4");
    const cc_cont_p5 = document.getElementById("cc_cont_p5");

    const cc_imgpreview = document.getElementById("cc_imgpreview");
    const cc_size = document.getElementById("cc_size");
    const cc_flavor = document.getElementById("cc_flavor");
    const cc_filling = document.getElementById("cc_filling");
    const cc_cover = document.getElementById("cc_cover");
    const cc_border = document.getElementById("cc_border");

    const cc_effects = document.getElementById("cc_effects");

    const transparentPixel = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggIeDtdxFwAAAABJRU5ErkJggg==";
    cc_size.src = transparentPixel;
    cc_flavor.src = transparentPixel;
    cc_filling.src = transparentPixel;
    cc_cover.src = transparentPixel;
    cc_border.src = transparentPixel;

    cc_effects.src = transparentPixel;
    cc_effects.loop = false;

    var audio = new Audio('files/beep.wav');


    const imagecont = document.getElementById("imagecont");
    const canvasimage = document.getElementById("canvasImage");
    canvasimage.src = transparentPixel;
    var canvas = document.getElementById("canvas");


    finish_bt.onclick = function () {
        cc_effects.src = transparentPixel;
        canExit = true;
        translateCakedata();
        //chat gpt :3
        // Clone the imagecont div
        var clone = imagecont.cloneNode(true);
        clone.style.width = "900px";
        clone.style.height = "1200px";

        // Append the clone to the document (so it becomes part of the DOM and images are loaded)
        document.body.appendChild(clone);

        // Create a temporary canvas
        var tempCanvas = document.createElement('canvas');
        var tempCtx = tempCanvas.getContext('2d');

        // Set the dimensions of the temporary canvas
        tempCanvas.width = 900;
        tempCanvas.height = 1200;

        // Draw the contents of the clone onto the temporary canvas
        html2canvas(clone).then(function (tempCanvas) {
            // Set the dimensions of the canvas to match the captured content
            canvas.width = tempCanvas.width;
            canvas.height = tempCanvas.height;
            console.log(canvas.width + " x " + canvas.height);

            // Get the context of the canvas
            var ctx = canvas.getContext('2d');

            // Draw the captured content from the temporary canvas onto the main canvas
            ctx.drawImage(tempCanvas, 0, 0);

            // Set the data URL of the canvas to the src attribute of the image
            canvasimage.src = canvas.toDataURL('image/png');
            var image = canvas.toDataURL('image/png');

            // Remove the clone from the document
            clone.remove();

            //chat gpt tmb
            fetch(image)
                .then(res => res.blob())
                .then(blob => {
                    var file = new File([blob], 'generated_image.png', { type: 'image/png' });
                    var dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    cakeimg.files = dataTransfer.files;
                });
        });

        createConfirm.showModal();
    }

    closedialog.onclick = function () {
        canExit = false;
        createConfirm.style.animation = "dialog-close 0.4s";
        createConfirm.style.animationFillMode = "forwards";
        setTimeout(() => {
            createConfirm.close();
            createConfirm.style.animation = "none";
            canvasimage.src = transparentPixel;
        }, 390);
    }


    buttons1.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons1).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })
            bt.classList.add("cc_button_chosen");

            if (chosen_values[0] != bt.id) {
                cc_effects.src = transparentPixel;
                cc_effects.src = "files/cakecreator/effect_star.gif";
            }

            chosen_values[0] = bt.id;
            input.value = chosen_values.join(', ');
            next_bt.disabled = false;

            updatePrice(curPage, bt.id, 0);
            visitedPages[curPage] = true;

            cc_imgpreview.src = transparentPixel;
            cc_size.src = "files/cakecreator/" + bt.id + ".png"
            previousSelected[0] = bt.id;
        })
    })


    buttons2.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons2).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })
            bt.classList.add("cc_button_chosen");

            if (chosen_values[1] != bt.id) {
                cc_effects.src = transparentPixel;
                cc_effects.src = "files/cakecreator/effect_brush.gif";
            }

            chosen_values[1] = bt.id;
            input.value = chosen_values.join(', ');
            next_bt.disabled = false;

            updatePrice(curPage, bt.id, 1);
            visitedPages[curPage] = true;

            cc_flavor.src = "files/cakecreator/" + bt.id + ".png"
            previousSelected[1] = bt.id;
        })
    })


    buttons3.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons3).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })
            bt.classList.add("cc_button_chosen");

            if (chosen_values[2] != bt.id && bt.id != "option_filling0") {
                cc_effects.src = transparentPixel;
                cc_effects.src = "files/cakecreator/effect_splash.gif";
            }

            chosen_values[2] = bt.id;
            input.value = chosen_values.join(', ');
            next_bt.disabled = false;

            updatePrice(curPage, bt.id, 2);
            visitedPages[curPage] = true;

            cc_filling.src = "files/cakecreator/" + bt.id + ".png"
            previousSelected[2] = bt.id;
        })
    })


    buttons4.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons4).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })
            bt.classList.add("cc_button_chosen");

            if (chosen_values[3] != bt.id && bt.id != "option_cover0") {
                cc_effects.src = transparentPixel;
                if (bt.id == "option_cover2") {
                    cc_effects.src = "files/cakecreator/effect_dripALT.gif";
                } else {
                    cc_effects.src = "files/cakecreator/effect_drip.gif";
                }
            }

            chosen_values[3] = bt.id;
            input.value = chosen_values.join(', ');
            next_bt.disabled = false;

            updatePrice(curPage, bt.id, 3);
            visitedPages[curPage] = true;

            if (bt.id == "option_cover0") {
                cc_cover.src = transparentPixel;
                if (chosen_values[4] != "" && chosen_values[4] != "option_border0") {
                    cc_border.src = "files/cakecreator/" + chosen_values[4] + ".png"
                }
            } else {
                cc_cover.src = "files/cakecreator/" + bt.id + ".png"
                if (chosen_values[4] != "" && chosen_values[4] != "option_border0") {
                    cc_border.src = "files/cakecreator/" + chosen_values[4] + "b.png"
                }
            }


            previousSelected[3] = bt.id;

        })
    })


    buttons5.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons5).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })
            bt.classList.add("cc_button_chosen");

            if (chosen_values[4] != bt.id && bt.id != "option_border0") {
                cc_effects.src = transparentPixel;
                cc_effects.src = "files/cakecreator/effect_" + bt.id + ".gif";
            }

            chosen_values[4] = bt.id;
            input.value = chosen_values.join(', ');
            next_bt.disabled = true;

            updatePrice(curPage, bt.id, 4);
            visitedPages[curPage] = true;

            finish_bt.disabled = false;

            if (bt.id == "option_border0") {
                cc_border.src = transparentPixel;
            } else {
                if (chosen_values[3] != "option_cover0") {
                    cc_border.src = "files/cakecreator/" + bt.id + "b.png"
                } else {
                    cc_border.src = "files/cakecreator/" + bt.id + ".png"
                }
            }

            previousSelected[4] = bt.id;
        })
    })


    next_bt.addEventListener("click", () => {
        if (curPage < 5) {
            visitedPages[curPage] = true;
            curPage++;
            changePage(curPage);
        }
    })

    back_bt.addEventListener("click", () => {
        if (curPage > 1) {
            curPage--;
            changePage(curPage);
        }
    })

    function playBeep() {
        audio.pause();
        audio.volume = 0.2;
        audio.currentTime = 0;
        audio.play();
    }

    function changePage(number) {
        switch (number) {
            case 1:
                hideAll();
                cc_cont_p1.style.display = "block";
                back_bt.disabled = true;
                checkNextBT(number);
                break;
            case 2:
                hideAll();
                cc_cont_p2.style.display = "block";
                back_bt.disabled = false;
                checkNextBT(number);
                break;
            case 3:
                hideAll();
                cc_cont_p3.style.display = "block";
                back_bt.disabled = false;
                checkNextBT(number);
                break;
            case 4:
                hideAll();
                cc_cont_p4.style.display = "block";
                back_bt.disabled = false;
                checkNextBT(number);
                break;
            case 5:
                hideAll();
                cc_cont_p5.style.display = "block";
                next_bt.disabled = true;
                back_bt.disabled = false;
                break;
            default:
                break;
        }
    }

    function checkNextBT(number) {
        if (visitedPages[number] == false) {
            next_bt.disabled = true;
        } else {
            next_bt.disabled = false;
        }
    }

    function hideAll() {
        cc_cont_p1.style.display = "none";
        cc_cont_p2.style.display = "none";
        cc_cont_p3.style.display = "none";
        cc_cont_p4.style.display = "none";
        cc_cont_p5.style.display = "none";
    }

    function formatCOP(value) {
        return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 }).format(value);
    }

    function updatePrice(curPage, id, ix) {
        playBeep();
        const format = id.split(/(\d+)/); // ["option_data", "0"];

        //optionPrices["option_data"]["0"].p
        op_obj = optionPrices[format[0]][format[1]].p;
        console.log(op_obj)

        const ps_pre_format = previousSelected[ix];
        console.log(previousSelected[ix]);
        const ps_format = ps_pre_format.split(/(\d+)/);
        console.log(ps_format)

        prev_opobj = optionPrices[ps_format[0]][ps_format[1]].p;
        console_log(prev_opobj)

        if (visitedPages[curPage] == true) {
            total -= prev_opobj.price;
            total += op_obj.price;
            price.textContent = "Precio " + formatCOP(total);
        } else {
            total += op_obj.price;
            price.textContent = "Precio " + formatCOP(total);
        }
        console.log("Pág. " + curPage + " : " + visitedPages[curPage] + "")
    }

    function translateCakedata() {
        let getSize = optionPrices[chosen_values[0]];
        let getFlavor = optionPrices[chosen_values[1]];
        let getFilling = optionPrices[chosen_values[2]];
        let getCover = optionPrices[chosen_values[3]];
        let getBorder = optionPrices[chosen_values[4]];

        cd_size = getSize.label;
        cd_flavor = getFlavor.label;
        cd_filling = getFilling.label;
        cd_cover = getCover.label;
        cd_border = getBorder.label;

        let finalData = [cd_size, cd_flavor, cd_filling, cd_cover, cd_border];
        let ingredients = [getSize.ingredients, getFlavor.ingredients, getFilling.ingredients, getCover.ingredients, getBorder.ingredients]

        cakedesc.value = finalData.join(', ') + ".";
        cakeprice.value = total;
        cakeing.value = "<b>Tamaño: </b>" + ingredients[0] + ".<br><b>Sabor del bizcocho: </b>" + ingredients[1] + ".<br><b>Relleno: </b>" + ingredients[2] + ".<br><b>Cobertura: </b>" + ingredients[3] + ".<br><b>Bordeado: </b>" + ingredients[4] + ".";
    }
});


window.addEventListener('beforeunload', (event) => {
    if (!canExit) {
        // Check if the user has unsaved progress
        // Display a confirmation dialog
        event.preventDefault();
        event.returnValue = ''; // For modern browsers
        return ''; // For older browsers
    }
});