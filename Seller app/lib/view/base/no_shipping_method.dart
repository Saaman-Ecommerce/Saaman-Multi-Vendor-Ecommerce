import 'package:flutter/material.dart';
import 'package:Saaman_Vendor/localization/language_constrants.dart';
import 'package:Saaman_Vendor/utill/dimensions.dart';
import 'package:Saaman_Vendor/utill/images.dart';
import 'package:Saaman_Vendor/utill/styles.dart';

class NoShippingDataScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.all(Dimensions.PADDING_SIZE_LARGE),
      child: Center(
        child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Image.asset(
                Images.shipping,
                width: MediaQuery.of(context).size.height * 0.22,
                height: MediaQuery.of(context).size.height * 0.22,
                color: Theme.of(context).primaryColor,
              ),
              Text(
                getTranslated('no_shipping_method', context),
                style: titilliumBold.copyWith(
                    color: Theme.of(context).primaryColor,
                    fontSize: MediaQuery.of(context).size.height * 0.023),
                textAlign: TextAlign.center,
              ),
            ]),
      ),
    );
  }
}
