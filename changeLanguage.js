
"use strict";

function changeText()
{

    //let context1 = document.getElementById("temp");

     var language = {
        eng:{
            text: "lorem ipsum"
        },
        rus:{
            text: "ывфывффыыыы"
        },
        ukr:{
            text: "Ще не вмерла України, ні слава, ні воля,\n" +
                "Ще нам, браття молодії, усміхнеться доля!\n" +
                "Згинуть наші воріженьки, як роса на сонці,\n" +
                "Запануєм і ми, браття, у своїй сторонці!\n" +
                "Душу й тіло ми положим за нашу свободу\n" +
                "І — покажем, що ми, браття, козацького роду!\n" +
                "Душу й тіло ми положим за нашу свободу\n" +
                "І — покажем, що ми, браття, козацького роду!"
        }
    };


    if (window.location.hash) {
        // if (window.location.hash === "#eng")     {         context1.textContent = language.eng.text;     }

        switch (window.location.hash) {
            case "#eng":
                temp.textContent = language.eng.text;
                break;
            case "#rus":
                temp.textContent = language.rus.text;
                break;
            case "#ukr":
                temp.textContent = language.ukr.text;
                break;
        }
    }


}
