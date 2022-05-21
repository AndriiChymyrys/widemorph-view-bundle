/**
 * Register module components globally
 *
 * @param app
 * @param components
 */
export const registerComponents = function (app, components) {
    for (let component in components) {
        app.component(component, components[component]);
    }
}

/**
 * Register module directives globally
 *
 * @param app
 * @param directives
 */
export const registerDirectives = function (app, directives) {
    for (let directive in directives) {
        app.directive(directive, directives[directive]);
    }
}
