let canExit = false;

document.addEventListener("DOMContentLoaded", () => {
    let curPage = 1;
    let curSlot = 0; //for cake code assigning
    let visitedPages = [false, false, false, false, false, false];
    let chosen_values = ["", "", "", "", ""];
    let previousSelected = ["", "", "", "", ""];
    let total = 0;
    let cake_is_finished = false;

    let option_price = null;
    let previous_option_price = null;

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


            {
                p: 4000,
                l: 'Bizcocho con sabor a Fresa',
                i: 'Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, fresas trituradas, colorante rosado',
                c: "7"
            },


            {
                p: 4000,
                l: 'Bizcocho con sabor a Mora',
                i: 'Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, moras trituradas.',
                c: "7"
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

            {
                p: 7000,
                l: "Fresas con crema",
                i: "Fresas, crema de leche, leche condensada, azucar",
                c: "13"
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

            {
                p: 6000,
                l: "Bordeado de media cubierta",
                i: "Leche, crema de leche, esencia de vainilla",
                c: "6"
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

            {
                p: 4000,
                l: "Bordeado de Cerezas",
                i: "Cerezas frescas",
                c: "7"
            },

            {
                p: 9000,
                l: "Bordeado de Frutos del bosque y Chocolate",
                i: "Mora, fresa, chocolate negro",
                c: "8"
            },
        ]
    };

    const optionNames = [
        "option_size",
        "option_flavor",
        "option_filling",
        "option_cover",
        "option_border"
    ]

    const main_cakecode = ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0"];
    const max_options = [
        (optionPrices[optionNames[0]].length - 1),
        (optionPrices[optionNames[1]].length - 1),
        (optionPrices[optionNames[2]].length - 1),
        (optionPrices[optionNames[3]].length - 1),
        (optionPrices[optionNames[4]].length - 1)
    ]; //the max digits of options there are, each value is a category

    console.log(max_options)


    const price = document.getElementById("price");

    const input = document.getElementById("cake_params");
    const input2 = document.getElementById("cake_paramsOLD");
    const next_bt = document.getElementById("option_next");
    const back_bt = document.getElementById("option_back");

    const cakecode_string = document.getElementById("cakecode_string");

    const finish_bt = document.getElementById("option_finish");
    const createConfirm = document.getElementById("createConfirm");
    const closedialog = document.getElementById("closeCrCf");


    const showExtra = document.getElementById("showExtra");
    const extra_bt = document.getElementById("option_extra");
    const closeExtra = document.getElementById("closeExtra");
    const confirm_cakecode = document.getElementById("confirm_cakecode");

    const cakeExistsModule = document.getElementById("cakeExistsModule");
    const closeCakeExists = document.getElementById("closeCakeExists");
    const cakeExistsBt = document.getElementById("cakeExistsBt");

    const cakedesc = document.getElementById("cakedesc");
    const cakeprice = document.getElementById("cakeprice");
    const cakeimg = document.getElementById("cakeimg");
    const cakeing = document.getElementById("cakeing");
    const cakecode = document.getElementById("cakecode");

    //CakeDesc = cd
    let cd_size = null;
    let cd_flavor = null;
    let cd_filling = null;
    let cd_cover = null;
    let cd_border = null;


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

    const audio = new Audio('files/sounds/beep.wav');
    const audioback = new Audio('files/sounds/back.wav');
    const audioacc = new Audio('files/sounds/accept2.wav');
    const audiofinish = new Audio('files/sounds/finish.wav');
    const audiotwinkle = new Audio('files/sounds/twinkle.wav');
    const audioaccept3 = new Audio('files/sounds/accept3.wav');
    const audiodeny = new Audio('files/sounds/deny.wav');


    const imagecont = document.getElementById("imagecont");
    const canvasimage = document.getElementById("canvasImage");
    canvasimage.src = transparentPixel;
    const canvas = document.getElementById("canvas");

    updatePreviewPos();


    finish_bt.onclick = function () {
        playBeep(audiofinish);
        cc_effects.src = transparentPixel;
        canExit = true;

        checkCake(input.value);
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

            button_pressHandler(bt, 0);
        })
    })

    buttons2.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons2).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            button_pressHandler(bt, 1);
        })
    })


    buttons3.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons3).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            button_pressHandler(bt, 2);
        })
    })


    buttons4.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons4).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            button_pressHandler(bt, 3);
        })
    })


    buttons5.forEach(bt => {
        bt.addEventListener('click', () => {
            const otherB = Array.from(buttons5).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            button_pressHandler(bt, 4);
        })
    })


    next_bt.addEventListener("click", () => {
        if (curPage < 5) {
            playBeep(audioacc);
            visitedPages[curPage] = true;
            curPage++;
            curSlot += 2;
            changePage(curPage);
        }
    })

    back_bt.addEventListener("click", () => {
        if (curPage > 1) {
            playBeep(audioback);
            curPage--;
            curSlot -= 2;
            changePage(curPage);
        }
    })

    extra_bt.addEventListener("click", () => {
        playBeep(audiotwinkle);

        showExtra.showModal();
    })

    const random_cakecode = document.getElementById("random_cakecode");
    const input_cakecode = document.getElementById("input_cakecode");
    const cakecode_warning = document.getElementById("cakecode_warning");

    random_cakecode.addEventListener("click", () => {
        const r_si = getRndInteger(1, max_options[0]); //size
        const r_si2 = (r_si > 9) ? r_si.toString() : "0" + r_si.toString();
        const r_si3 = r_si2.split('')

        const r_fl = getRndInteger(1, max_options[1]); //flavor
        const r_fl2 = (r_fl > 9) ? r_fl.toString() : "0" + r_fl.toString();
        const r_fl3 = r_fl2.split('')

        const r_fi = getRndInteger(0, max_options[2]); //filling
        const r_fi2 = (r_fi > 9) ? r_fi.toString() : "0" + r_fi.toString();
        const r_fi3 = r_fi2.split('')

        const r_co = getRndInteger(0, max_options[3]); //cover
        const r_co2 = (r_co > 9) ? r_co.toString() : "0" + r_co.toString();
        const r_co3 = r_co2.split('')

        const r_bo = getRndInteger(0, max_options[3]); //border/toppings
        const r_bo2 = (r_bo > 9) ? r_bo.toString() : "0" + r_bo.toString();
        const r_bo3 = r_bo2.split('')

        const final_rcode = [
            r_si3[0], r_si3[1],
            r_fl3[0], r_fl3[1],
            r_fi3[0], r_fi3[1],
            r_co3[0], r_co3[1],
            r_bo3[0], r_bo3[1]
        ]

        input_cakecode.value = final_rcode.join('');

        useCakecode();
    })

    confirm_cakecode.addEventListener("click", () => {
        useCakecode();
    })

    closeExtra.addEventListener("click", () => {
        showExtra.style.animation = "dialog-close 0.4s";
        showExtra.style.animationFillMode = "forwards";
        setTimeout(() => {
            showExtra.close();
            showExtra.style.animation = "none";
        }, 390);
    })

    closeCakeExists.addEventListener("click", () => {
        cakeExistsModule.style.animation = "dialog-close 0.4s";
        cakeExistsModule.style.animationFillMode = "forwards";
        setTimeout(() => {
            cakeExistsModule.close();
            cakeExistsModule.style.animation = "none";
        }, 390);
    })



    //---------------FUNCTIONS---------------
    //src: https://www.w3schools.com/js/js_random.asp
    function getRndInteger(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    function useCakecode() {
        const icc_length = input_cakecode.value.toString().length;

        if (icc_length != 10 || icc_length > 10) {
            cakecode_warning.textContent = "El codigo debe ser de 10 dígitos.";
            playBeep(audiodeny);
            return;
        }

        let count = 0;
        let continue_success = false;

        for (let i = 0; i < 10; i += 2) {
            const pair = input_cakecode.value.substring(i, i + 2); // Get a pair of characters

            const [fc, sc] = pair.split('');

            main_cakecode[count] = fc;
            main_cakecode[count + 1] = sc;

            const pairNum = +pair;

            if (pairNum > max_options[count]) {
                cakecode_warning.textContent = "El código no es una combinación válida.";
                playBeep(audiodeny);
                continue_success = false;
                return;
            }

            chosen_values[count] = pairNum.toString();
            previousSelected[count] = chosen_values[count];
            count++;

            continue_success = true;
        }

        if (continue_success == false) {
            chosen_values = ["", "", "", "", ""]
            main_cakecode = ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0"];
            return;
        }


        cakecode_warning.textContent = "";
        cc_imgpreview.src = transparentPixel;

        buttons1.forEach(bt => {
            const otherB = Array.from(buttons1).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            let button = optionNames[0] + chosen_values[0];
            button = document.getElementById(button);
            button.classList.add("cc_button_chosen");
            cc_size.src = "files/cakecreator/" + optionNames[0] + chosen_values[0] + ".png";
        })

        buttons2.forEach(bt => {
            const otherB = Array.from(buttons2).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            let button = optionNames[1] + chosen_values[1];
            button = document.getElementById(button);
            button.classList.add("cc_button_chosen");
            cc_flavor.src = "files/cakecreator/" + optionNames[1] + chosen_values[1] + ".png";
        })

        buttons3.forEach(bt => {
            const otherB = Array.from(buttons3).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            let button = optionNames[2] + chosen_values[2];
            button = document.getElementById(button);
            button.classList.add("cc_button_chosen");

            cc_filling.src = (chosen_values[2] == "0") ? transparentPixel : "files/cakecreator/" + optionNames[2] + chosen_values[2] + ".png";
        })

        buttons4.forEach(bt => {
            const otherB = Array.from(buttons4).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            let button = optionNames[3] + chosen_values[3];
            button = document.getElementById(button);
            button.classList.add("cc_button_chosen");
            cc_cover.src = (chosen_values[3] == "0") ? transparentPixel : "files/cakecreator/" + optionNames[3] + chosen_values[3] + ".png";
        })

        buttons5.forEach(bt => {
            const otherB = Array.from(buttons5).filter(ob => ob !== bt);
            otherB.forEach(obs => {
                obs.classList.remove("cc_button_chosen");
            })

            let button = optionNames[4] + chosen_values[4];
            button = document.getElementById(button);
            button.classList.add("cc_button_chosen");

            if (chosen_values[4] == "0") {
                cc_border.src = transparentPixel;
                return;
            }

            const wCover = "files/cakecreator/" + optionNames[4] + chosen_values[4] + "b.png";
            const woCover = "files/cakecreator/" + optionNames[4] + chosen_values[4] + ".png";

            cc_border.src = (chosen_values[3] == "0" || chosen_values[3] == "6") ? woCover : wCover;
        })

        updateWholePrice();
        cc_effects.src = "files/cakecreator/effect_star.gif";
        finish_bt.disabled = false;
        next_bt.disabled = (curPage != 5) ? false : true;
        back_bt.disabled = (curPage != 1) ? false : true;

        visitedPages = [true, true, true, true, true, true]
        input.value = input_cakecode.value;


        playBeep(audioaccept3);

        showExtra.style.animation = "dialog-close 0.4s";
        showExtra.style.animationFillMode = "forwards";
        setTimeout(() => {
            showExtra.close();
            showExtra.style.animation = "none";
        }, 390);
    }

    function startRendering() {
        translateCakedata();
        //chat gpt :3
        // Clone the imagecont div
        let clone = imagecont.cloneNode(true);
        clone.style.width = "900px";
        clone.style.height = "1200px";
        clone.style.position = "absolute";
        clone.style.left = "-9999px"; // Position off-screen

        // Append the clone to the document (so it becomes part of the DOM and images are loaded)
        document.body.appendChild(clone);
        // Create a temporary canvas
        let tempCanvas = document.createElement('canvas');

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
            let ctx = canvas.getContext('2d', { willReadFrequently: true });

            // Draw the captured content from the temporary canvas onto the main canvas
            ctx.drawImage(tempCanvas, 0, 0);

            // Set the data URL of the canvas to the src attribute of the image
            canvasimage.src = canvas.toDataURL('image/png');
            let image = canvas.toDataURL('image/png');

            // Remove the clone from the document
            clone.remove();

            //chat gpt tmb
            fetch(image)
                .then(res => res.blob())
                .then(blob => {
                    let file = new File([blob], 'generated_image.png', { type: 'image/png' });
                    let dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    cakeimg.files = dataTransfer.files;
                });
        });

        createConfirm.showModal();
    }

    function checkCake(ccode) {
        fetch('fetch/checkifcake.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `cakecode=${encodeURIComponent(ccode)}`
        })

            .then(response => response.json())
            .then(data => {
                if (data.success !== false) {
                    const id = data.success;
                    cakeExistsModule.showModal();
                    cakeExistsBt.href = `viewproduct.php?id=${id}&sc=0`;
                } else {
                    startRendering();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


    function button_pressHandler(bt, num) {
        bt.classList.add("cc_button_chosen");

        const target = bt.id.split(/(\d+)/);

        //GIF EFFECT
        switch (num) {
            case 0:
                cc_size.src = "files/cakecreator/" + bt.id + ".png"
                if (chosen_values[num] != target[1]) {
                    cc_effects.src = transparentPixel;
                    cc_effects.src = "files/cakecreator/effect_star.gif";
                }
                break;

            case 1:
                cc_flavor.src = "files/cakecreator/" + bt.id + ".png"
                if (chosen_values[num] != target[1]) {
                    cc_effects.src = transparentPixel;
                    cc_effects.src = "files/cakecreator/effect_brush.gif";
                }
                break;

            case 2:
                cc_filling.src = "files/cakecreator/" + bt.id + ".png"
                if (chosen_values[num] != target[1] && target[1] != "0") {
                    cc_effects.src = transparentPixel;
                    cc_effects.src = "files/cakecreator/effect_splash.gif";
                }
                break;

            case 3:
                //this is for changing and adapting the toppings texture if the user changes the border when toppings are alr set
                if (target[1] == "0" || target[1] == "6") {
                    cc_cover.src = (target[1] == 0) ? transparentPixel : "files/cakecreator/" + bt.id + ".png";
                    if (chosen_values[4] != "" && chosen_values[4] != "0") {
                        cc_border.src = "files/cakecreator/option_border" + chosen_values[4] + ".png"
                    }
                } else {
                    cc_cover.src = "files/cakecreator/" + bt.id + ".png"
                    if (chosen_values[4] != "" && chosen_values[4] != "0") {
                        cc_border.src = "files/cakecreator/option_border" + chosen_values[4] + "b.png"
                    }
                }

                //this is for the effect
                if (chosen_values[num] != target[1] && target[1] != "0") {
                    cc_effects.src = transparentPixel;
                    if (target[1] == "2") {
                        cc_effects.src = "files/cakecreator/effect_dripALT.gif";
                    } else {
                        cc_effects.src = "files/cakecreator/effect_drip.gif";
                    }
                }
                break;

            case 4:
                //this is for setting the right topping size texture
                if (target[1] == "0") {
                    cc_border.src = transparentPixel;
                } else {
                    if (chosen_values[3] != "0" && chosen_values[3] != "6") {
                        cc_border.src = "files/cakecreator/" + bt.id + "b.png"
                    } else {
                        cc_border.src = "files/cakecreator/" + bt.id + ".png"
                    }
                }

                //this is for the effect
                if (chosen_values[num] != target[1] && target[1] != "0") {
                    cc_effects.src = transparentPixel;
                    cc_effects.src = "files/cakecreator/effect_" + bt.id + ".gif";
                }
                break;

            default:
                break;
        }

        chosen_values[num] = target[1]; //assiging the number (option_data"0") >> "0" <<

        if (parseInt(target[1]) < 10) {
            main_cakecode[curSlot] = 0;
            main_cakecode[curSlot + 1] = target[1];
        } else {
            const split = target[1].split('');

            main_cakecode[curSlot] = split[0];
            main_cakecode[curSlot + 1] = split[1];
        }

        input.value = main_cakecode.join('');
        input2.value = chosen_values.join('')

        next_bt.disabled = num != 4 ? false : true;

        updatePrice(curPage, target[1], num);
        visitedPages[curPage] = true;

        cc_imgpreview.src = transparentPixel;

        previousSelected[num] = target[1];

        if (num == 4 && cake_is_finished == false) {
            cake_is_finished = true;
            finish_bt.disabled = false;
        }

        console.log("ID Botón: " + chosen_values[num])
    }

    function playBeep(audio) {
        const url = audio.src;
        const parts = url.split('/');
        const filename = parts[parts.length - 1];

        audio.pause();
        if (filename == "twinkle.wav" || filename == "back.wav") {
            audio.volume = 0.1;
        } else {
            audio.volume = 0.2;
        }
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

    function updateWholePrice() {
        total = 0;
        for (let index = 0; index < optionNames.length; index++) {
            total += optionPrices[optionNames[index]][chosen_values[index]].p;
            price.textContent = "Calculando precio..."
        }

        price.textContent = "Precio " + formatCOP(total);
    }

    function updatePrice(curPage, id, ix) {
        //curPage == pageNumber
        //id == button id sent by func
        //ix == button/slot we're in for chosen_values array (pg 1 -> 0, pg 2 -> 1)

        playBeep(audio);

        //optionPrices["option_data"]["0"].p
        option_price = optionPrices[optionNames[ix]][id].p;
        console.log("Precio elegido: " + option_price)

        previous_option_price = previousSelected[ix] != "" ? optionPrices[optionNames[ix]][previousSelected[ix]].p : 0;
        console.log("Precio anterior: " + previous_option_price)

        if (visitedPages[curPage] == true) {
            total -= previous_option_price;
            total += option_price;
            price.textContent = "Precio " + formatCOP(total);
        } else {
            total += option_price;
            price.textContent = "Precio " + formatCOP(total);
        }
        console.log("Pág. " + curPage + " : " + visitedPages[curPage] + "")
    }

    function translateCakedata() {

        let getSize = optionPrices["option_size"][chosen_values[0]];
        let getFlavor = optionPrices["option_flavor"][chosen_values[1]];
        let getFilling = optionPrices["option_filling"][chosen_values[2]];
        let getCover = optionPrices["option_cover"][chosen_values[3]];
        let getBorder = optionPrices["option_border"][chosen_values[4]];

        cd_size = getSize.l;
        cd_flavor = getFlavor.l;
        cd_filling = getFilling.l;
        cd_cover = getCover.l;
        cd_border = getBorder.l;

        let finalData = [cd_size, cd_flavor, cd_filling, cd_cover, cd_border];
        let ingredients = [getSize.i, getFlavor.i, getFilling.i, getCover.i, getBorder.i]

        cakedesc.value = finalData.join(', ') + ".";
        cakeprice.value = total;
        cakecode_string.textContent = "CÓDIGO DE PASTEL: " + input.value;
        cakecode.value = input.value;
        cakeing.value = "<b>Tamaño: </b>" + ingredients[0] + ".<br><b>Sabor del bizcocho: </b>" + ingredients[1] + ".<br><b>Relleno: </b>" + ingredients[2] + ".<br><b>Cobertura: </b>" + ingredients[3] + ".<br><b>Bordeado: </b>" + ingredients[4] + ".";
    }

    window.onscroll = function () {
        updatePreviewPos();
    };

    function updatePreviewPos() {
        const scrollY = window.scrollY; // Get scroll position
        const newTop = scrollY + 95; // Adjust movement based on scroll (e.g., move half as fast)
        imagecont.style.top = `${newTop}px`; // Update container position
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