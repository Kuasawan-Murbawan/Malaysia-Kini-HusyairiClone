import { Component, OnInit, inject, signal, effect } from '@angular/core';
import { News } from '../../services/news';
import { NewsCard } from '../news-card/news-card';

@Component({
  selector: 'app-news-list',
  standalone: true,
  imports: [NewsCard],
  templateUrl: './news-list.html',
  styleUrl: './news-list.css',
})
export class NewsList implements OnInit {
  private newsService = inject(News);
  stories = signal<any[]>([]);
  loading = signal(true);

  constructor() {
    effect(() => {
      const category = this.newsService.selectedCategory();
      this.fetchNews(category ?? undefined);
    });
  }

  ngOnInit(): void {}

  private fetchNews(categorySlug?: string): void {
    this.loading.set(true);
    this.newsService.getNews(categorySlug).subscribe({
      next: (response: any) => {
        this.stories.set(response.data);
        this.loading.set(false);
      },
      error: (err) => {
        console.error('Failed to load news', err);
        this.loading.set(false);
      },
    });
  }
}
