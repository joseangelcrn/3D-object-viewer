/**
 * File extensions allowed by app, only files with this extension will be able uploaded to backend
 */

const allowed_extensions = [
    'stl',
    'obj',
    'fbx',
    'collada',
    '3ds',
    'iges',
    'step',
    'vrml',
    'x3d'
];

export const extensions = Object.freeze(
    allowed_extensions
);

