import { Injectable, inject, signal } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';

@Injectable({ providedIn: 'root' })
export class News {
  private http = inject(HttpClient);
  private baseUrl = 'http://localhost:8000/api';

  selectedCategory = signal<string | null>(null);

  getNews(categorySlug?: string, page: number = 1) {
    let params = new HttpParams().set('page', page.toString());
    if (categorySlug) {
      params = params.set('category', categorySlug);
    }
    return this.http.get(`${this.baseUrl}/news`, { params });
  }

  getStory(id: number) {
    return this.http.get(`${this.baseUrl}/news/${id}`);
  }

  getCategories() {
    return this.http.get(`${this.baseUrl}/categories`);
  }
}
