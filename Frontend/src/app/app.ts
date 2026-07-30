import { Component } from '@angular/core';
import { NewsList } from './components/news-list/news-list';
import { Navbar } from './components/navbar/navbar';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [NewsList, Navbar],
  templateUrl: './app.html',
  styleUrl: './app.css',
})
export class App {}
