let workDuration = 25 * 60; // 25 minutes
let shortBreak = 5 * 60; // 5 minutes
let longBreak = 15 * 60; // 15 minutes

let timeLeft = workDuration;
let isRunning = false;
let isWorkSession = true;
let currentCycle = 1;

const timerDisplay = document.getElementById('timer');
const startButton = document.getElementById('start');
const resetButton = document.getElementById('reset');
const sessionsInput = document.getElementById('sessions');
const notificationSound = document.getElementById('notification-sound');

startButton.addEventListener('click', () => {
    if (!isRunning) {
        startTimer();
    } else {
        pauseTimer();
    }
});

resetButton.addEventListener('click', resetTimer);

function startTimer() {
    isRunning = true;
    startButton.textContent = 'Pause';
    timer = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(timer);
            notificationSound.play('notification/Ping!'); // link to the notification sound
            if (isWorkSession) {
                currentCycle++;
                if (currentCycle > sessionsInput.value * 2) {
                    alert('Pomodoro cycles completed!');
                    resetTimer();
                    return;
                } else if (currentCycle % 2 === 0) {
                    timeLeft = shortBreak;
                    alert('Short break time!');
                } else {
                    timeLeft = workDuration;
                    alert('Work session time!');
                }
            } else {
                if (currentCycle / 2 >= sessionsInput.value) {
                    timeLeft = longBreak;
                    alert('Long break time!');
                } else {
                    timeLeft = workDuration;
                }
            }
            isWorkSession = !isWorkSession;
            startTimer();
        } else {
            updateTimerDisplay();
            timeLeft--;
        }
    }, 1000);
}

function pauseTimer() {
    isRunning = false;
    startButton.textContent = 'Start';
    clearInterval(timer);
}

function resetTimer() {
    clearInterval(timer);
    timeLeft = workDuration;
    isWorkSession = true;
    currentCycle = 1;
    isRunning = false;
    startButton.textContent = 'Start';
    updateTimerDisplay();
}

function updateTimerDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timerDisplay.textContent = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}
