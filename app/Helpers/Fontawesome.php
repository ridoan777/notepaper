<?php

namespace App\Helpers;

class Fontawesome
{
	// ----------------HOME----------------------
	public static function home(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" $attrString fill="currentColor">
				<path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
			</svg>
			SVG;
	}
	// -----------------COPY---------------------
	public static function copy(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor">
				<path d="M208 0L332.1 0c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9L448 336c0 26.5-21.5 48-48 48l-192 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48zM48 128l80 0 0 64-64 0 0 256 192 0 0-32 64 0 0 48c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 176c0-26.5 21.5-48 48-48z"/>
			</svg>
			SVG;
	}
	// -----------------PASTE---------------------
	public static function paste(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor">
				<path d="M192 0c-41.8 0-77.4 26.7-90.5 64L64 64C28.7 64 0 92.7 0 128L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64l-37.5 0C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM112 192l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
				</svg>
			SVG;
	}
		
	// ----------------STATIC FIXED METHOD---------------------
	protected static function buildAttributes(array $attrs): string
	{
		return collect($attrs)
			->map(fn($v, $k) => $k . '="' . e($v) . '"')
			->implode(' ');
	}
}
