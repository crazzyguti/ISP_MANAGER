class Point {
    constructor() {
        this.x = 10;
        this.y = 10;
    }

    move(x, y) {
        this.x += x;
        this.y += y;
    }

    setPoint(x, y) {
        this.x = x;
        this.y = y;
    }

    toString() {
        return this.x + ',' + this.y;
    }
}


let Points = [];

for (let i = 0; i < 20; i++) {
    Points[i] = new Point();
}
console.log(Points);
