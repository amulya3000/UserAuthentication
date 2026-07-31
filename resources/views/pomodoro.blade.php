<?php
/**
 * resources/views/pomodoro.blade.php
 * Pomodoro Timer page with private notes (saved in localStorage) and admin notes section.
 * Uses Tailwind CSS for styling, includes a simple JS timer and note handling.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pomodoro Timer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center py-8">
    <div class="max-w-md w-full glass p-6">
        <h1 class="text-2xl font-bold text-center text-white mb-4">Pomodoro Timer</h1>
        <div id="timerDisplay" class="text-5xl font-mono text-center text-white mb-4">25:00</div>
        <div class="flex justify-center space-x-4 mb-6">
            <button id="startBtn" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded">Start</button>
            <button id="pauseBtn" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-500 text-white rounded" disabled>Pause</button>
            <button id="resetBtn" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded" disabled>Reset</button>
        </div>
        <h2 class="text-xl font-semibold text-white mb-2">Private Notes</h2>
        <textarea id="privateNotes" rows="4" class="w-full p-2 rounded" placeholder="Your private notes (saved locally)"></textarea>
        <button id="saveNotes" class="mt-2 w-full bg-blue-600 hover:bg-blue-500 text-white py-1 rounded">Save Notes</button>
        <h2 class="text-xl font-semibold text-white mt-6 mb-2">Admin Notes</h2>
        <div id="adminNotesContainer" class="bg-white bg-opacity-30 p-2 rounded h-24 overflow-y-auto text-white">
            <p class="text-center italic">No admin notes.</p>
        </div>
    </div>
    <script>
        const display=document.getElementById('timerDisplay');
        const startBtn=document.getElementById('startBtn');
        const pauseBtn=document.getElementById('pauseBtn');
        const resetBtn=document.getElementById('resetBtn');
        let timerInterval=null;
        let totalSeconds=25*60;
        function updateDisplay(){
            const mins=String(Math.floor(totalSeconds/60)).padStart(2,'0');
            const secs=String(totalSeconds%60).padStart(2,'0');
            display.textContent=;
        }
        startBtn.addEventListener('click',()=>{
            if(timerInterval) return;
            timerInterval=setInterval(()=>{
                if(totalSeconds>0){
                    totalSeconds--;
                    updateDisplay();
                }else{
                    clearInterval(timerInterval);
                    timerInterval=null;
                    alert('Pomodoro completed!');
                }
            },1000);
            startBtn.disabled=true;
            pauseBtn.disabled=false;
            resetBtn.disabled=false;
        });
        pauseBtn.addEventListener('click',()=>{
            clearInterval(timerInterval);
            timerInterval=null;
            startBtn.disabled=false;
            pauseBtn.disabled=true;
        });
        resetBtn.addEventListener('click',()=>{
            clearInterval(timerInterval);
            timerInterval=null;
            totalSeconds=25*60;
            updateDisplay();
            startBtn.disabled=false;
            pauseBtn.disabled=true;
            resetBtn.disabled=true;
        });
        const notesElem=document.getElementById('privateNotes');
        const saveBtn=document.getElementById('saveNotes');
        const NOTE_KEY='pomodoro_private_notes';
        notesElem.value=localStorage.getItem(NOTE_KEY)||'';
        saveBtn.addEventListener('click',()=>{
            localStorage.setItem(NOTE_KEY,notesElem.value);
            alert('Notes saved locally');
        });
    </script>
</body>
</html>
