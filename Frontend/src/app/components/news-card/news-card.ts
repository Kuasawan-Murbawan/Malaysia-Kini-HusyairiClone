import { Component, input } from '@angular/core';

@Component({
  selector: 'app-news-card',
  standalone: true,
  templateUrl: './news-card.html',
  styleUrl: './news-card.css',
})
export class NewsCard {
  story = input<any>();

  timeAgo(dateString: string): string {
    const then = new Date(dateString).getTime();
    const now = Date.now();
    const diffSeconds = Math.floor((now - then) / 1000);

    if (diffSeconds < 60) return `${diffSeconds}s ago`;
    const diffMinutes = Math.floor(diffSeconds / 60);
    if (diffMinutes < 60) return `${diffMinutes}m ago`;
    const diffHours = Math.floor(diffMinutes / 60);
    if (diffHours < 24) return `${diffHours}h ago`;
    const diffDays = Math.floor(diffHours / 24);
    return `${diffDays}d ago`;
  }
}
