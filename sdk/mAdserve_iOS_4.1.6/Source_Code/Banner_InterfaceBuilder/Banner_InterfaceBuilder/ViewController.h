//
//  ViewController.h
//  Banner_InterfaceBuilder
//

#import <UIKit/UIKit.h>
#import <AdSdk/AdSdk.h>

@interface ViewController : UIViewController <AdSdkBannerViewDelegate>

@property (weak, nonatomic) IBOutlet AdSdkBannerView *bannerView;

@end
