let flag
let context
let draw_interval
let angle = 0

function clearArea(){
    context.clearRect(0,0,flag.width,flag.height)
}

function createStripe(offset,color){
  let width = flag.width
  let height = offset + flag.height
  let amplitude = 7
  let frequency = 35
  let x = 0
  let y = 0


  context.beginPath()
  context.moveTo(x,height)
  
  if (color == 'white') {
    context.lineTo(x,height)
  
  while (x < width) {
      y = offset + amplitude * Math.sin(x/frequency + angle)
      context.lineTo(x, y)
      x = x + 1
  }
  
  context.lineTo(width,height)
  context.strokeStyle = 'black'
  context.stroke()
  } else {
    while (x < width) {
        y = offset + amplitude * Math.sin(x/frequency + angle)
        context.lineTo(x, y)
        x = x + 1
    }
    context.lineTo(width,height)
    context.fillStyle = color
    context.fill()
    context.closePath()
    context.beginPath()
  }

}

function createFlag() {
  clearArea()  
  createStripe(8,'white')
  createStripe(flag.height/3,'#396fbf') 
  createStripe(flag.height/1.5,'#ed485b')
  createStripe(flag.height-15,'#ffffff')
  angle = (angle + 2*Math.PI - Math.PI/15)%(2*Math.PI)
}

function setup(){
  flag = document.getElementById("flag")
  context = flag.getContext("2d")
  draw_interval = setInterval(createFlag,150)
}