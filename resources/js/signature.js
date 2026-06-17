<script>
const canvas = document.getElementById("signature");
const ctx = canvas.getContext("2d");

let drawing = false;

canvas.onmousedown = () => drawing = true;
canvas.onmouseup = () => drawing = false;

canvas.onmousemove = e => {
    if(!drawing) return;
    ctx.lineWidth = 2;
    ctx.lineCap = "round";
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
}

function saveSignature(){
    document.getElementById('signature_data').value =
    canvas.toDataURL();
}
</script>