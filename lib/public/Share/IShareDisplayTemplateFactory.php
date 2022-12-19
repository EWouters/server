<?php

namespace OCP\Share;

interface IShareDisplayTemplateFactory {
	/**
	 * Register new display share template
	 * @param class-string<IShareDisplayTemplateProvider> $shareDisplayTemplateClass
	 * @param \Closure(IShare $share): bool $condition
	 * @return void
	 */
	public function registerDisplayShareTemplate(string $shareDisplayTemplateClass, \Closure $condition): void;

	public function getTemplate(IShare $share): IShareDisplayTemplateProvider;
}
