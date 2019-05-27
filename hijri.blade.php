<link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />
<link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111" />
<title>CodePen - Hijri/Gregorian Datepicker Demo</title>
<link rel='stylesheet' href='https://ZulNs.github.io/w3css/w3.css'>

<style>
    .w3-bar-item{border-left:6px solid transparent!important}
    .w3-bar-item:not(:disabled):hover{border-color:#f44336!important}
    .w3-bar-item:focus{border-color:#2196F3!important}
    .w3-bar-item.expanded{color:#fff;background-color:#616161}
    button.collapsed + div,button.collapsed>:nth-child(3),button.expanded>:nth-child(2){display:none!important}
    .w3-bar-item input[type=radio],.w3-bar-item label{cursor:pointer}
    .w3-bar-item:focus-within{border-color:#2196F3!important}

</style>
<script>
    window.console = window.console || function(t) {};
</script>
<script>
    if (document.location.search.match(/type=embed/gi)) {
        window.parent.postMessage("resize", "*");
    }
</script>


<div class="w3-container w3-margin-top">
    <label for="hijrDate"><i class="far fa-calendar-alt"></i></label>
    <input id="hijrDate" onclick="pickDate(event)" class="w3-input w3-border" type="text" >
</div>


<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
<script src='https://ZulNs.github.io/HijriDate.js/hijri-date.js'></script>
<script src='https://ZulNs.github.io/Datepicker.js/datepicker.js'></script>
<script id="rendered-js">
    'use strict';
    let picker = new Datepicker();
    let pickElm = picker.getElement();
    let pLeft = 200;
    let pWidth = 300;
    pickElm.style.position = 'absolute';
    pickElm.style.left = pLeft + 'px';
    pickElm.style.top = '172px';
    picker.attachTo(document.body);

    picker.onPicked = function () {
        let elgd = document.getElementById('gregDate');
        let elhd = document.getElementById('hijrDate');
        if (picker.getPickedDate() instanceof Date) {
            elgd.value = picker.getPickedDate().getDateString();
            elhd.value = picker.getOppositePickedDate().getDateString();
        } else {
            elhd.value = picker.getPickedDate().getDateString();
            elgd.value = picker.getOppositePickedDate().getDateString();
        }
    };

    function openSidebar() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function closeSidebar() {
        document.getElementById("mySidebar").style.display = "none";
    }

    function dropdown(el) {
        if (el.className.indexOf('expanded') == -1) {
            el.className = el.className.replace('collapsed', 'expanded');
        } else {
            el.className = el.className.replace('expanded', 'collapsed');
        }
    }

    function selectLang(el) {
        el.children[0].checked = true;
        picker.setLanguage(el.children[0].value);
    }

    function setFirstDay(fd) {
        picker.setFirstDayOfWeek(fd);
    }

    function setYear() {
        let el = document.getElementById('valYear');
        picker.setFullYear(el.value);
    }

    function setMonth() {
        let el = document.getElementById('valMonth');
        picker.setMonth(el.value);
    }

    function updateWidth(el) {
        pWidth = parseInt(el.value);
        if (!fixWidth()) {
            document.getElementById('valWidth').value = pWidth;
            picker.setWidth(pWidth);
        }
    }

    function pickDate(ev) {
        ev = ev || window.event;
        let el = ev.target || ev.srcElement;
        pLeft = ev.pageX;
        fixWidth();
        pickElm.style.top = ev.pageY + 'px';
        picker.setHijriMode(el.id == 'hijrDate');
        picker.show();
        el.blur();
    }

    function gotoToday() {
        picker.today();
    }

    function setTheme() {
        let el = document.getElementById('txtTheme');
        let n = parseInt(el.value);
        if (!isNaN(n)) picker.setTheme(n);else
            picker.setTheme(el.value);
    }

    function newTheme() {
        picker.setTheme();
    }

    function fixWidth() {
        let docWidth = document.body.offsetWidth;
        let isFixed = false;
        if (pLeft + pWidth > docWidth) pLeft = docWidth - pWidth;
        if (docWidth >= 992 && pLeft < 200) pLeft = 200;else
        if (docWidth < 992 && pLeft < 0) pLeft = 0;
        if (pLeft + pWidth > docWidth) {
            pWidth = docWidth - pLeft;
            picker.setWidth(pWidth);
            document.getElementById('valWidth').value = pWidth;
            document.getElementById('sliderWidth').value = pWidth;
            isFixed = true;
        }
        pickElm.style.left = pLeft + 'px';
        return isFixed;
    }
    //# sourceURL=pen.js
</script>
<script src="https://static.codepen.io/assets/editor/live/css_reload-5619dc0905a68b2e6298901de54f73cefe4e079f65a75406858d92924b4938bf.js"></script>
