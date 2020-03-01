 let myList = document.querySelector("#myList");
 var canvas = document.getElementById("myCanvas");
 var ctx = canvas.getctx("2d");

 function redraw() {
     draw(myList.value);
 }

 function draw(speed) {
     ctx.clearRect(0, 0, canvas.width, canvas.height);
     var centerX = canvas.width / 2;
     var centerY = canvas.height / 2;
     var radius = canvas.height / 2 - 20;

     ctx.beginPath();
     ctx.arc(centerX, centerY, radius, Math.PI * 0.10, Math.PI * -1.1, true);

     var gradience = ctx.createRadialGradient(centerX, centerY, radius - radius / 2, centerX, centerY, radius - radius / 8);
     gradience.addColorStop(0, '#ff9000');
     gradience.addColorStop(1, '#000000');

     ctx.fillStyle = gradience;
     ctx.fill();
     ctx.closePath();
     ctx.restore();

     ctx.beginPath();
     ctx.strokeStyle = '#ffff00';
     ctx.translate(centerX, centerY);
     var increment = 5;
     ctx.font = "15px Helvetica";
     for (var i = -18; i <= 18; i++) {
         angle = Math.PI / 30 * i;
         sineAngle = Math.sin(angle);
         cosAngle = -Math.cos(angle);

         if (i % 5 == 0) {
             ctx.lineWidth = 8;
             iPointX = sineAngle * (radius - radius / 4);
             iPointY = cosAngle * (radius - radius / 4);
             oPointX = sineAngle * (radius - radius / 7);
             oPointY = cosAngle * (radius - radius / 7);

             wPointX = sineAngle * (radius - radius / 2.5);
             wPointY = cosAngle * (radius - radius / 2.5);
             ctx.fillText((i + 18) * increment, wPointX - 2, wPointY + 4);
         } else {
             ctx.lineWidth = 2;
             iPointX = sineAngle * (radius - radius / 5.5);
             iPointY = cosAngle * (radius - radius / 5.5);
             oPointX = sineAngle * (radius - radius / 7);
             oPointY = cosAngle * (radius - radius / 7);
         }
         ctx.beginPath();
         ctx.moveTo(iPointX, iPointY);
         ctx.lineTo(oPointX, oPointY);
         ctx.stroke();
         ctx.closePath();
     }
     var numOfSegments = speed / increment;
     numOfSegments = numOfSegments - 18;
     angle = Math.PI / 30 * numOfSegments;
     sineAngle = Math.sin(angle);
     cosAngle = -Math.cos(angle);
     pointX = sineAngle * (3 / 4 * radius);
     pointY = cosAngle * (3 / 4 * radius);

     ctx.beginPath();
     ctx.strokeStyle = '#000000';
     ctx.arc(0, 0, 19, 0, 2 * Math.PI, true);
     ctx.fill();
     ctx.closePath();

     ctx.beginPath();
     ctx.lineWidth = 6;
     ctx.moveTo(0, 0);
     ctx.lineTo(pointX, pointY);
     ctx.stroke();
     ctx.closePath();
     ctx.restore();
     ctx.translate(-centerX, -centerY);
 }

 window.addEventListener('load', (event) => {
     console.log('page is fully loaded');
 });

 myList.addEventListener("input", (e) => {
     draw(e.target.value);
 });
