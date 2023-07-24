"use strict";
const lampButton = document.querySelector(".lamp-button");
lampButton?.addEventListener("click", () => {
  document.body.classList.toggle("off");
});

class Clock {
  constructor(container) {
    this.container = container;
  }
  render() {
    this.container.textContent = this.time;
  }
  get time() {
    return moment().format("hh:mm:ss");
  }
  start() {
    this.render();
    this.setTimer();
  }
  setTimer() {
    window.setInterval(() => {
      this.render();
    }, 1000);
  }
}

const containerSelector = document.getElementById("hms");
const clock = new Clock(containerSelector);
clock.start();
