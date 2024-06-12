import './bootstrap';
import 'flowbite';
import 'preline'
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
window.Alpine = Alpine;
Alpine.plugin(persist)
Alpine.start();