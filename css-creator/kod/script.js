let boxcolor;
function changetext(){
    let text = document.getElementById('tekst').value;
    document.getElementById('0️⃣').innerHTML = text;
}

function changeboxcolor(){
    let boxcolor = document.getElementById('boxcolor').value;
    let newboxcolor = ("backround-color: " + boxcolor);
    document.getElementById('1️⃣').innerHTML = newboxcolor;
}

function changeradius(){
    let zaokraglanie = document.getElementById('zaokraglenie').value;
    let newzaokraglenie = ("border-radius: " + zaokraglanie + "px");
    document.getElementById('2️⃣').innerHTML = newzaokraglenie;
}

function changeborderwidth(){
    let grubosc = document.getElementById('grubosc').value;
    let newgrubosc = ("border-width: " + grubosc + "px;");
    document.getElementById('3️⃣').innerHTML = newgrubosc;
}

function changebordercolor(){
    let bordercolor = document.getElementById('bordercolor').value;
    let newbordercolor = ("border-color: " + bordercolor + ";");
    document.getElementById('4️⃣').innerHTML = newbordercolor;
}

function changebordertype(){
    let bordertype = document.getElementById('bordertype').value;
    let newbordertype = ("border-type: " + bordertype + ";");
    document.getElementById('5️⃣').innerHTML = newbordertype;
}

function changeboxshadow(){
    let boxshadowx = document.getElementById('boxshadowx').value;
    let boxshadowy = document.getElementById('boxshadowy').value;
    let boxshadowblur = document.getElementById('boxshadowblur').value;
    let boxshadowcolor = document.getElementById('boxshadowcolor').value;
    let newboxshadow = ("box-shadow: " + boxshadowx + "px " + boxshadowy + "px " + boxshadowblur + "px " + boxshadowcolor);
    document.getElementById('6️⃣').innerHTML = newboxshadow;
}

function changetextcolor(){
    let textcolor = document.getElementById('textcolor').value;
    let newtextcolor = ("color: " + textcolor + ";");
    document.getElementById('7️⃣').innerHTML = newtextcolor;    
}

function changefontname(){
    let fontname = document.getElementById('fontname').value;
    let newfontname = ("font-family: " + fontname + ";");
    document.getElementById('8️⃣').innerHTML = newfontname;
}

function changefontsize(){
    let fontsize = document.getElementById('fontsize').value;
    let newfontsize = ("font-size: " + fontsize + "px;");
    document.getElementById('9️⃣').innerHTML = newfontsize;
}

function changetextalign(){
    let textalign = document.getElementById('textalign').value;
    let newtextalign = ("text-align: " + textalign + ";");
    document.getElementById('1️⃣0️⃣').innerHTML = newtextalign;
}

function changetextshadow(){
    let textshadowx = document.getElementById('textshadowx').value;
    let textshadowy = document.getElementById('textshadowy').value;
    let textshadowblur = document.getElementById('textshadowblur').value;
    let textshadowcolor = document.getElementById('textshadowcolor').value;
    let newtextshadow = ("text-shadow: " + textshadowx + "px " + textshadowy + "px " + textshadowblur + "px " + textshadowcolor);
    document.getElementById('1️⃣1️⃣').innerHTML = newtextshadow;
}

function changecss(){
    let boxcolor = document.getElementById('boxcolor').value;
    let newboxcolor = ("background-color: " + boxcolor + ";");
    let zaokraglanie = document.getElementById('zaokraglenie').value;
    let newzaokraglenie = ("border-radius: " + zaokraglanie + "px;");
    let grubosc = document.getElementById('grubosc').value;
    let newgrubosc = ("border-width: " + grubosc + "px;");
    let bordercolor = document.getElementById('bordercolor').value;
    let newbordercolor = ("border-color: " + bordercolor + ";");
    let bordertype = document.getElementById('bordertype').value;
    let newbordertype = ("border-style: " + bordertype + ";");
    let boxshadowx = document.getElementById('boxshadowx').value;
    let boxshadowy = document.getElementById('boxshadowy').value;
    let boxshadowblur = document.getElementById('boxshadowblur').value;
    let boxshadowcolor = document.getElementById('boxshadowcolor').value;
    let newboxshadow = ("box-shadow: " + boxshadowx + "px " + boxshadowy + "px " + boxshadowblur + "px " + boxshadowcolor + ";");
    let textcolor = document.getElementById('textcolor').value;
    let newtextcolor = ("color: " + textcolor + ";");
    let fontname = document.getElementById('fontname').value;
    let newfontname = ("font-family: " + fontname + ";");
    let fontsize = document.getElementById('fontsize').value;
    let newfontsize = ("font-size: " + fontsize + "px;");
    let textalign = document.getElementById('textalign').value;
    let newtextalign = ("text-align: " + textalign + ";");
    let textshadowx = document.getElementById('textshadowx').value;
    let textshadowy = document.getElementById('textshadowy').value;
    let textshadowblur = document.getElementById('textshadowblur').value;
    let textshadowcolor = document.getElementById('textshadowcolor').value;
    let newtextshadow = ("text-shadow: " + textshadowx + "px " + textshadowy + "px " + textshadowblur + "px " + textshadowcolor + ";");
    let height = "height: 350px;";
    let width = "width: 70%;";
    let margin = "margin: auto;";
    let margintop = "margin-top: 1rem;";
    let marginbottom = "margin-bottom: 1rem;";
    let aspectratio = "aspect-ratio: 16 / 9;";


    let finishcss = (".🖼️{" + newboxcolor + newzaokraglenie + newgrubosc + newbordercolor + newbordertype + newboxshadow + newtextcolor + newfontname + newfontsize + newtextalign + newtextshadow + height + width + margin + margintop + marginbottom + aspectratio + "}");
    document.getElementById('🖼️').innerHTML = finishcss;

}
