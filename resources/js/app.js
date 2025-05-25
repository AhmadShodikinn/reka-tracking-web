import './bootstrap';
import Alpine from 'alpinejs';
import { persist } from '@alpinejs/persist';
import searchDocumentComponent from './components/shippingSearch';
import searchUserComponent from './components/userSearch';

window.Alpine = Alpine;

window.searchDocumentComponent = searchDocumentComponent;
window.userSearchComponent = searchUserComponent; 

Alpine.plugin(persist);

Alpine.start();

// console.log('Alpine loaded:', Alpine);
// console.log('searchDocumentComponent loaded:', searchDocumentComponent);
// console.log('userSearchComponent loaded:', searchUserComponent);