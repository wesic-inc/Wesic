<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 bloc">
            <div class="inner-bloc">


<ul>
    <li class="dragdrop" ondrop="drop(event)" ondragover="allowDrop(event)"> 
    <div class="dragdrop" draggable="true" ondragstart="drag(event)" id="drag1" width="88" height="31">NAVBAR</div>
    </li>
    <li class="dragdrop" ondrop="drop(event)" ondragover="allowDrop(event)"> </li>
    <li class="dragdrop" ondrop="drop(event)" ondragover="allowDrop(event)"> </li>
    <li class="dragdrop" ondrop="drop(event)" ondragover="allowDrop(event)"> </li>
    <li class="dragdrop" ondrop="drop(event)" ondragover="allowDrop(event)"> </li>
</ul>

</div>
        </div>
    </div>
</div>



<style>
li.dragdrop {
    width: 100px;
    height: 35px;
    margin: 10px;
    padding: 10px;
    border: 1px solid black;
}

</style>

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}
</script>