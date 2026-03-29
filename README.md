# erp-media-package

Global media package for the entire ERP system.

## Polymorphic media attachments

- `Erp\MediaPackage\Models\Media` exposes a `relatedModel()` morph-to relation.
- `Erp\MediaPackage\Traits\HasMedia` can be used by any ERP module model.
- `attachMedia(string $mediaId)` and `detachMedia(string $mediaId)` delegate to the service layer and update `related_model_type` / `related_model_id`.
